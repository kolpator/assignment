

Instructions;

For our php based application we will use helm charts to deploy our app-stack
whic includes;

phpfpm container builded custom with script.php app
nginx cntainer for serving http requests;
Redis cluster for in-memory cache;
Postgresql Cluster for Relational db;


Assumptions;

Docker must be installed, you must have valid docker account  (for buildingand pushing  image to docker-hub) 
Virtualbox must be installed  (for macos users; use homebrew  "brew cask install virtualbox"  if you dont have homebrew please install from https://www.virtualbox.org/wiki/Downloads)
Kubectl must be installed  >>  https://kubernetes.io/docs/tasks/tools/install-minikube/#install-minikube
Minikube must be installed; >>  https://kubernetes.io/docs/tasks/tools/install-kubectl/
Helm must be installed >> https://helm.sh/docs/using_helm/#installing-helm


When you checkout git repository; you will subfolder; 
