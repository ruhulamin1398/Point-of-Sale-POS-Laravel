if any trigger happend on database then we add new  row in  queue table , every time cron job will check is queue table has any data, if queue has data 
1. call api with post request with oldest data 
1. if request is success then another request will be happend to verify change 
1. if chenge verified then delete this row and go to next row 
1. if data doesn't sync then call step 1 
1. loop will continue till queue table has any data 


## queue table schema 

id, 
model_name,
data(json format)
