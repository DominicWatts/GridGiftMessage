# Pixie Media GiftMessage

Gift message on sales order grid 

Requires patch for 'Created At' filtering

**filter.patch**

```sh
diff --git a/vendor/magento/module-sales/Plugin/Model/ResourceModel/Order/OrderGridCollectionFilter.php b/vendor/magento/module-sales/Plugin/Model/ResourceModel/Order/OrderGridCollectionFilter.php index 995bb8335..cff4b8971 100644
--- a/vendor/magento/module-sales/Plugin/Model/ResourceModel/Order/OrderGridCollectionFilter.php
+++ b/vendor/magento/module-sales/Plugin/Model/ResourceModel/Order/OrderGridCollectionFilter.php @@ -52,7 +52,7 @@ class OrderGridCollectionFilter
                 }
             }
 
-            $fieldName = $subject->getConnection()->quoteIdentifier($field);
+            $fieldName = $subject->getConnection()->quoteIdentifier('main_table.' . $field);
             $condition = $subject->getConnection()->prepareSqlCondition($fieldName, $condition);
             $subject->getSelect()->where($condition, null, Select::TYPE_CONDITION);

```
