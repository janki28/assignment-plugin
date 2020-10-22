# **Assignment Plugin**

Hello I am [Janki](https://janki1028.wordpress.com/).
This plugin is developed during the WordPress Training Program provided by [rtCamp](https://rtcamp.com). You can also find my WordPress Learning Report [here](https://janki1028.wordpress.com/2020/10/14/time-to-wrap-up/). 

The **requirements** for the plugin can be found [here](https://learn.rtcamp.com/topic/plugin-development-assignment/).

The working **demo** can be found [here](https://jankiassignment-theme.000webhostapp.com/). This demo consists of Books plugin as well as theme demo.

**Note: The demo link is only for demonstration purpose. It includes limited posts.**

## **Description**
## The main directories and files include:

+ `admin\` : Contains all admin side functionalities
  + `css\books-admin.css` : This file contains admin side styles and layouts
  + `js\books-admin.js` : This file contains admin side scripts
  + `partials\books-admin-display.php` : This file is used to markup the admin-facing aspects of the plugin.
  + `class-books-admin.php` : This file contains the admin-specific functionality of the plugin.
+ `includes\` : Contains the following files:
  + `class-books.php` : This file registers all of the hooks related to the admin area functionality of the plugin.
  + `class-books-activator.php` : This file defines all code necessary to run during the plugin's activation.
  + `class-books-deactivator.php` : This file defines all code necessary to run during the plugin's deactivation.
  + `class-books-i18n.php` : This file loads and defines the internationalization files for this plugin so that it is ready for translation.
  + `class-books-loader.php` : This file registers all actions and filters for the plugin.
  + `widgets.php` : This file contains custom widgets for the plugin.

+ `languages\` : Contains pot template for localization.
+ `public\` : Contains all user side functionality files
    + `css\books-public.css` : This file contains user side styles and layouts.
    + `js\books-public.js` : This file contains user side scripts.
    + `partials\books-public-display.php` : This file is used to markup the public-facing aspects of the plugin.

    + `class-books-public.php` : This file contains the public-facing functionality of the plugin.

+ `books.php` : This file is read by WordPress to generate the plugin information in the plugin admin area. It also includes all of the dependencies used by the plugin, registers the activation and deactivation functions, and defines a function that starts the plugin.
+ `uninstall.php` : This file is fired when the plugin is uninstalled.

## **Installation**
This Plugin is not available on WordPress marketplace, thus you will have to manually upload this plugin to the website directory. 

**Here are the steps how you can downlaod and set up the plugin**
  1. Download the zip folder.
  2. Go to WordPress website root directory and navigate to `wp-content\plugins` folder.
  3. Extract the zip here.
  4. Login to WordPress admin panel and navigate to `Plugins`.
  5. A new plugin named `WP Book` by [Janki](https://janki1028.wordpress.com/) should be available.
  6. Click on `Activate`.
  
**Here are the steps to use the plugin**
  1. On activating the plugin, a custom post type named `books` is enabled.
  2. You can manage all the books from section available in the admin panel titled as `Books`.
  3. You can store additional information related to a particular book such as Author, Publisher, Year, Price, Book URL, Category, Tag. This information is stored in a custom database table which is created upon activation of the plugin.
  4. A sub-menu titled as `Book Settings` lets you
      + change the currency of book price 
      + books to be displayed per page(as seen on the website).
  5. A shortcode `[book]` displays book information related to a particular book such as Author, Publisher, Year, Price, Book URL, Category, Tag.
  
  6. There are two widgets
        + A sidebar widget named as `Book Category`.
        + A dashboard widget named as `Top 5 Book Categories` based on count. 
  7. The plugin has also been internationalized.

## **Screenshots**

### **Activate**

![activate](https://github.com/janki28/assignment-plugin/blob/main/SCREENSHOTS/plugin.PNG)

### **Books**

![plugin](https://github.com/janki28/assignment-plugin/blob/main/SCREENSHOTS/book%20plugin.PNG)

### **Meta Box**

![metabox](https://github.com/janki28/assignment-plugin/blob/main/SCREENSHOTS/meta%20box1.PNG)

### **Taxonomy**

![taxonomy](https://github.com/janki28/assignment-plugin/blob/main/SCREENSHOTS/taxonomy.jpg)

### **Book Settings**

![settings](https://github.com/janki28/assignment-plugin/blob/main/SCREENSHOTS/book%20setting.PNG)

### **Shortcode**

![shortcode](https://github.com/janki28/assignment-plugin/blob/main/SCREENSHOTS/short%20code.jpg)

### **Sidebar Widget**

![sidebar](https://github.com/janki28/assignment-plugin/blob/main/SCREENSHOTS/sidebar.jpg)

### **Dashboard Widget**

![dashboard](https://github.com/janki28/assignment-plugin/blob/main/SCREENSHOTS/dashboard%20category.PNG)
