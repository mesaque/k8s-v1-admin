# kubernetes admin sample app version 1

what we are going to do? we will build an app completely scalable vertically and horizontally using a kubernetes infrastructure design, so get tighten your belts and enjoy the learning situation.

![K8s Flow Draw](infrastructure/k8s.png?raw=true "K8s Flow Draw")

### Prerequisites

There are a things you need to have configured in your machine to get the commands going right.

 - [gcloud](https://cloud.google.com/sdk/gcloud/)
 - [kubectl](https://kubernetes.io/docs/tasks/tools/install-kubectl/)
 - [minikube](https://kubernetes.io/docs/tasks/tools/install-minikube/)
 - [gcp account activated](https://cloud.google.com/)


## How to configure Kubernets on GCP

> [k8s][GCP]Create a namespace for our test project
```
kubectl create namespace k8s-v1-admin
```

###### creating a cluster & nodes
> [GCP]auto scalling vertical
```
gcloud container clusters create k8s-v1-admin  --labels=environment=production,v=1,operator=mesaquesilva --min-nodes=2 --max-nodes=13 --enable-autoscaling --node-labels=environment=production
```

###### About Kubernets and how to build our project (GCP|minikube)
> [k8s]creating a controller
```
kubectl --namespace=k8s-v1-admin create -f k8s/deployment/admin-prod.yaml
```
> [k8s]creating a service
```
kubectl --namespace=k8s-v1-admin create -f k8s/service/admin-prod.yaml
```
> [k8s]scalling / horizontal (manual / automatic)
```
kubectl --namespace=k8s-v1-admin scale deployment/admin --replicas=6
kubectl --namespace=k8s-v1-admin autoscale deployment/admin --min=1 --max=15
```

> [k8s]deploy/update image ( when editing change the commit hash )
```
kubectl --namespace=k8s-v1-admin edit deployment/admin
```

###### How to manager contexts
>list context
```
kubectl config get-contexts
```
> change context from GCP to minikube
```
kubectl config use-context minikube
```

###### How to configure your local minikube to access GCR

> [k8s][minikube]Create namespace for our test project
```
kubectl create namespace k8s-v1-admin
```
1. 

 - Go to “IAM & Admin” section of the Google Cloud Console and select “Service Accounts”. Then click the “Create Service Account” button
 - select the option to “Furnish a new private key” with the “JSON” key type.
 - in role / papel select: roles/storage.objectViewer

> Dont forget of change in this string where are you json key and mail
2.  RUN:
```
kubectl --namespace=k8s-v1-admin create secret docker-registry gcr-json-key \
          --docker-server=https://gcr.io \
          --docker-username=_json_key \
          --docker-password="$(cat ~/Downloads/somekey.json)" \
          --docker-email=somemail@somehost.com
```
3.  RUN: 
```
kubectl --namespace=k8s-v1-admin patch serviceaccount default \
          -p '{"imagePullSecrets": [{"name": "gcr"}]}'
```
4. Now you have access to your gcr images
```
kubectl --namespace=k8s-v1-admin create -f k8s/deployment/admin-prod.yaml
kubectl --namespace=k8s-v1-admin create -f k8s/service/admin-prod.yaml
```


###### Utils
> get minikube project access url
minikube --namespace=k8s-v1-admin service admin --url 

:neckbeard:
> list pods (gcp|minikube) 
```
kubectl --namespace=k8s-v1-admin get pods
```
> list services
```
kubectl --namespace=k8s-v1-admin get services
```
> list deployments
```
kubectl --namespace=k8s-v1-admin get deployments
```