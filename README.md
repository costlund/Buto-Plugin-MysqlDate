# Buto-Plugin-MysqlDate
A table with dates to be used in queries. Run page /_/create with webmaster role to create 18629 records. One year before today to 50 years earlier.

## Settings
Run page /dates/create with webmaster role to create records.
```
plugin_modules:
  dates:
    plugin: mysql/date
    settings:
      mysql: 'yml:/../buto_data/theme/[theme]/mysql.yml'
```

## Schema
```
/plugin/mysql/date/mysql/schema.yml
```
