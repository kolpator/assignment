
Information

For our php based application we will use helm charts to deploy our app-stack
which includes;

phpfpm container builded with custom  index.php app
nginx container for serving http requests;
Redis cluster for in-memory cache;
Postgresql Cluster for Relational db;


Assumptions;

Docker must be installed, you must have valid docker account  (for buildingand pushing  image to docker-hub)
Virtualbox must be installed  (for macos users; use homebrew  "brew cask install virtualbox"  if you dont have homebrew please install from https://www.virtualbox.org/wiki/Downloads)
Kubectl must be installed  >>  https://kubernetes.io/docs/tasks/tools/install-minikube/#install-minikube
Minikube must be installed; >>  https://kubernetes.io/docs/tasks/tools/install-kubectl/
Helm must be installed >> https://helm.sh/docs/using_helm/#installing-helm





Note >> All terminal command higlighted  in " " but ofcourse you must give commands without ""  (:

#I forget to run minikube start command  (this is my mistake, im adding it now, but please be aware im adding after sendind repo link to your mail adresses)

First of all start one k8 machine
"minikube start"
First of all lets init tiller;

"helm init"       # initalize helm and tiller component
"helm repo update"   #  lets update repo charts
"helm repo add bitnami https://charts.bitnami.com/bitnami"    # for bitnami charts


Now its time to build our php container with nginx websever;  2 container in total

please check out git repository to somewhere convenient
change directory to assignment/app  folder;  

lets build our php app container;
"docker build . -t  kolpator/phpfpm-app:1.0"       (you can use your own docker username and tag, but after that you had to change  values.yaml file in app/helm-chart/ folder to responding changes)

push our image to docker hub

"docker push kolpator/phpfpm-app:1.0"

Now lets start to make our deployment with helm charts;

first lets create a namespace for our stack;

"kubectl create namespace dev"


Now change directory to assingment/redis
lets deploy our redis Cluster
"helm install  --namespace dev  --name my-redis stable/redis --values values-production.yaml"

if there is no problem lets change to assingment/postgres directory
lets deploy out postgredb;
"helm install   --namespace dev   --name postgredb stable/postgresql -f values-production.yaml --set postgresqlPassword=passw0rd,postgresqlDatabase=mylist --set replication.password=passw0rd"


cd to helm-chart directory  and run command;
"helm install --namespace dev  --name phpfpm .""
check deployment with command;
"helm ls"
you should phpfpm status deployed
lets get our nginx ip address with this command;
"minikube service list"
your output should be smilar;
dev         | phpfpm-php-app-nginx            | http://192.168.99.100:31029      (please use ip and port combination of output minikube)

lets acces our php app with browser ;
http://192.168.99.100:31029/index.php


Restore sample data to postgres;
well its embrassing but i cant find a nice way to import sql data to postgres with cli tools; so this task should be done from your side;
there is sql file in assignment/postgres  folder;
########################
postgredb-postgresql.sql
########################
thankfully i included adminer app in php-fpm container;
you can acces adminer via;

http://192.168.99.100:31029/adminer.php
user credentials;
################
user: postgres
################
password: passw0rd
######################
host: postgredb-postgresql

after login with adminer;    import postgredb-postgresql.sql file to   mylist database.

after that step you can access to phpapp via;

http://192.168.99.100:31029/index.php   #again you had to use your minikube servise ip   ( minikube service list  > get nginx container)
