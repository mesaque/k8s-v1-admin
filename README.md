# k8s-v1-admin

## create cluster project
```sh
gcloud container clusters create k8s-v1-admin  --labels=environment=production,v=1,operator=mesaquesilva --min-nodes=2 --max-nodes=13 --enable-autoscaling --node-labels=environment=production


kubectl create -f k8s/controller/admin-prod.yaml
kubectl create -f k8s/service/admin-prod.yaml

```

