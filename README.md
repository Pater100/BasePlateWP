# BasePlateWP
v0.2 of  BasePlatewP:

This template is based on the Sage Wordpress template by roots.io. It features composer, gulp and bower support but is stripped from some features like the wrapper.
BasePlatewP is maintained by Erik van der Bas as a starting point for small size WP projects that do not have an option to be deployed and run on shared hosting.
It is a solution which lies between the full-stack-development with projects like Sage and Bedrock and regular old fashioned Development with plain css/javascript/php.

This template can be used with the BasePlateHTML as a basis for complex HTML/CSS WP projects that can benefit from developing the plain HTML/CSS/Javascript basis first.
After using BasePlateHTML you can simply copy the whole assets map to the new BasePlateWP project and run gulp to compile. Then devide the HTML code to the template parts.

For using the template:

1.	npm install -g bower
2.  npm install --global gulp-cli
3.  npm install --save-dev gulp-load-plugins
3.  npm install --save-dev gulp
4.	bower install
5.  npm install
6.	gulp
