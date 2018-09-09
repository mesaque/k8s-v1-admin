# k8s-v1-admin

## Hot to configure Kubernets on GCP
```sh
// creating a cluster & nodes
// auto scalling vertical
gcloud container clusters create k8s-v1-admin  --labels=environment=production,v=1,operator=mesaquesilva --min-nodes=2 --max-nodes=13 --enable-autoscaling --node-labels=environment=production

// creating a controller
kubectl create -f k8s/deployment/admin-prod.yaml
// creating a service
kubectl create -f k8s/service/admin-prod.yaml

// scalling / horizontal
// manual
kubectl scale deployment/admin --replicas=6
// automatic
kubectl autoscale deployment/admin --min=1 --max=15


// deploy/update image
// when editing change the commit hash
kubectl edit deployment/admin


## How to manager contexts
//list context
kubectl config get-contexts

//change context from minikube to anything
kubectl config use-context minikube

```

## How to configure minikube to access gcr

1.  RUN: 
```
kubectl create namespace dev
```
2. 

 - Go to “IAM & Admin” section of the Google Cloud Console and select “Service Accounts”. Then click the “Create Service Account” button
 - select the option to “Furnish a new private key” with the “JSON” key type.
 - in role / papel select: roles/storage.objectViewer

> Dont forget of change in this string where are you json key and mail
3.  RUN:
```
kubectl --namespace=dev create secret docker-registry gcr-json-key \
          --docker-server=https://gcr.io \
          --docker-username=_json_key \
          --docker-password="$(cat ~/Downloads/somekey.json)" \
          --docker-email=somemail@somehost.com
```
4.  RUN: 
```
kubectl --namespace=dev patch serviceaccount default \
          -p '{"imagePullSecrets": [{"name": "gcr"}]}'
```
5. Now you have access to your gcr images
```
kubectl --namespace=dev create -f k8s/deployment/admin-prod.yaml
kubectl --namespace=dev create -f k8s/service/admin-prod.yaml
```


## Utils
> get minikube project access url
minikube service admin --url --namespace=dev

:neckbeard:
> list pods (gcp|minikube) 
```
kubectl get pods
kubectl --namespace=dev get pods
```
> list services
```
kubectl get services
kubectl --namespace=dev get services
```
> list deployments
```
kubectl get deployments
kubectl --namespace=dev get deployments
```
