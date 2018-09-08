# k8s-v1-admin

```sh
// auto scalling vertical
gcloud container clusters create k8s-v1-admin  --labels=environment=production,v=1,operator=mesaquesilva --min-nodes=2 --max-nodes=13 --enable-autoscaling --node-labels=environment=production

// create controller
kubectl create -f k8s/deployment/admin-prod.yaml
// create service
kubectl create -f k8s/service/admin-prod.yaml

// scalling / horizontal
// manual
kubectl scale deployment/admin --replicas=6
// automatic
kubectl autoscale deployment/admin --min=1 --max=15


// deploy/update image
// when editing change the commit hash
kubectl edit deployment/admin
```

