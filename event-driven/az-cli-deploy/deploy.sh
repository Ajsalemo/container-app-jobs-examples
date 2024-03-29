az containerapp job create \
    --name "my-job" --resource-group "your-rg" \
    --trigger-type "Event" \
    --replica-timeout 60 --replica-retry-limit 1 --replica-completion-count 1 --parallelism 1 \
    --image "youracr.azurecr.io/container-app-job-examples-event-driven:latest" \
    --registry-password "0000000000000000000000000000000000000000" \
    --registry-username "youracr" \
    --registry-server "youracr.azurecr.io" \
    --cpu "0.25" --memory "0.5Gi" \
    --min-executions "0" \
    --max-executions "10" \
    --scale-rule-name "blob" \
    --scale-rule-type "azure-blob" \
    --scale-rule-metadata "accountName=yourStorageAccount" "blobContainerName=yourContainerName" "blobCount=5" \
    --scale-rule-auth "connection=connection-string-secret" \
    --secrets "connection-string-secret=<YOUR_STORAGE_CONNECTION_STRING>"