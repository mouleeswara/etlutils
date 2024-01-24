# etlutils

## Firebase to MySQL

### Install PHP SDK and install kreait
```

composer require kreait/firebase-php

```

### modify credentials.json

### modify databaseUrl of your firebase.

### modify mysqlConfig section 
```
$mysqlConfig = [
    'host' => 'your_mysql_host',
    'user' => 'your_mysql_user',
    'password' => 'your_mysql_password',
    'database' => 'your_mysql_database',
]
```

### modify your firebase database path

```
 $firebasePath = '/your_firebase_path';
```

### change your MYSQL table name 
```
 $tableName = 'your_table';
```


### add how many column your migrating to MYSQL 
```
 $field1 = $value['field1'];
 ```


### Run your php in terminal

```
php firebase_to_mysql.php
```