# jxJiraConnect #

OXID eShop Admin Extension for Connecting Atlassian JIRA


## OXID Setup ##

For installing and using the module, you have to proceed the following steps:

1. Unzip the complete file with all the folder structures and upload the content of the folder copy_this to the root folder of your shop.
2. After this navigate in the admin backend of the shop to _Extensions_ - _Modules_. Select the module _jxJiraConnect_ and click on `Activate`.
4. Switch to the tab _Settings_ and setup the fields
    * JIRA Server Url eg. https://jira.myserver.vom
    * User and Password, eg. JiraUser / mypassword
    * Values for project and author
    * Field numbers (from JIRA) for customer no. and e-mail

## JIRA Setup ##

The issues created by the module _jxJiraConnect_ are using two custom fields of JIRA which allows to assign these issues to customers. These two custom fields are _Customer Number_ and _Customer EMail_ and have to be defined in JIRA as single line text fields. The internal numbers of the fields have to be stored in the module settings of _jxJiraConnect_.

**Tip:**
To get the internal field numbers, click in JIRA on the edit menu of the field and move the mouse over one of the menu items. Now you can see the Url at the bottom of the web browser, containing the internal field number.


## Screenshots ##

#### Settings ####
![Object History Log](https://github.com/job963/jxJiraConnect/raw/master/docs/img/settings-de.png)

#### Issue Info for each User ####
![Full Log Report](https://github.com/job963/jxJiraConnect/raw/master/docs/img/user-main-de.png)

#### Issues of a User ####
![Full Log Report](https://github.com/job963/jxJiraConnect/raw/master/docs/img/user-jiraissues-de.png)

#### Issue Info for each Order/User ####
![Full Log Report](https://github.com/job963/jxJiraConnect/raw/master/docs/img/order-main-de.png)

#### Issues of a User/Order ####
![Full Log Report](https://github.com/job963/jxJiraConnect/raw/master/docs/img/user-jiraissues-de.png)

#### All open Issues ####
![Full Log Report](https://github.com/job963/jxJiraConnect/raw/master/docs/img/user-allissues-de.png)


