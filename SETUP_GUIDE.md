# LXST ADMIN Setup

## Initial Landlord Setup

### Setup DNS

#### Setup an A record to the landlord/central domain
Example:
```
legacy.lxst-digital.co.uk
```

### Database Setup

### Login to server/mysql

For ploi:
- ssh@{ip_address}
- mysql -u ploi -p

#### Create a user:
```
CREATE USER 'lxst_admin'@'localhost' IDENTIFIED BY 'your_password_here';
```

#### Grant Privileges:
```
GRANT ALL PRIVILEGES ON *.* TO 'lxst_admin'@'localhost';
```

#### Update Privileges
```
FLUSH PRIVILEGES;
```

## ENV Setup

```
APP_URL=https://legacy.lxst-digital.co.uk
...
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=lxst_admin
DB_USERNAME=lxst_admin
...
LXST_ADMIN_URL=https://legacy.lxst-digital.co.uk
...
LXST_CENTRAL_DOMAINS=legacy.lxst-digital.co.uk
```

### Create Super User

```
landlord:create-super-user
```

## Tenant Setup

### Setup DNS

#### Setup an A record to the tenant domain
Example:
```
test-legacy.lxst-digital.co.uk
```

### Add domain aliases

For ploi only (otherwise this will be an NGINX config update)

### Create the tenant via landlord

When setting the domain use e.g. `test-legacy` vs `test-legacy.lxst-digital.co.uk`

### Update SSL certificate

Ensure e.g. test-legacy.lxst-digital.co.uk is added