# Team-Alpha-Marketplace
The SJSU Team Alpha Project

website link: http://teamalphamarket.com


### TAM:     Team Alpha Marketplace

**Test Case #1**: Create a user in TAM 
The Team Alpha Market allows creation of users/customers.  To test:
Navigate to the Team Alpha Market home page
Hover over the “login/sign-up” button on the upper right.
From the drop-down menu, click “create account” and a form will be shown.  For the email, some randomly obscure email address (not coolprofsinn@gmail.com, it already exists).
Fill in the form and click “create account” button to submit form.  
Navigation will return to the home page.  You can verify the user creation in Test Case #2.

**Test Case #2**: login user in TAM
User login to the Team Alpha Marketplace.  To test:
Navigate to the Team Alpha Market home page
Hover over the “login/sign-up” button on the upper right.
From the drop-down menu, click “login” and a login form will be shown.
Enter the email and passwords from Test CAse #1`


Click “login/sign-up” button on the upper right of home page, click ”login” and use existing user account “coolprofsinn@gmail.com” to login with password as “password”.  You may also use the account that was created in test case #1. 

**Test Case #3**:  top six products in the whole marketplace
The top six products are defined as the #1 for each of the six team sites.  These are displayed on the home page, in the scroll area under the “Hot Products At Team Alpha Market”.  To Test:
Navigate to the Team Alpha Market home page.
Note the first row is “Hot Products At Team Alpha Market”.
This is the top 6 products in the Team Alpha Market.

(**test case 4** and 4 are enabled by each member company through accessible API , e.g. https://yarnix.com/topfiveviewed/, and items are arranged in descending order by “viewCount”.)

**Test Case #5**:  Customer is auto login as TAM user when he/she clicks to a member site
When a TAM user clicks on a product and is directed to a member site, the TAM user token is included in the call.  The member site can make a Curl call back to TAM to obtain the user information, and can then create a user for the local site.  To test:

After completing Test Case #1 and #2, the user should be logged into TAM.
From the home page or “Shop” page, click on any “Whale” product.
User will be taken to the the Whale” marketplace.
At the top of the page, click “My account”.
In the middle of the page, verify that it says, “Hello <name from Test Case #2).

**Test Case #6**: Login Using TAM Token
In this test case, a user has logged into TAM, and then navigates to a TAM partner site in a way that does not transfer the user token.  The user can do fast login using the current TAM authentication.  To test:

Navigate to Roncabeanz.com.
If the user is logged in, hover over the “Hello <user>” button at the top right, and select <Log Out> from the drop-down menu.
Enter “www.teamalphamarket.com” in the browser address bar to navigate to the TAM Site.
Login to TAM using account “coolprofsinn@gmail.com” and password “password”.
Enter “www.roncabeanz.com” in the browser address bar to navigate to Roncabeanz without any user context.
Hover over the “Login/Sign-up” button at the top right of the page, and select “Login Using TAM”.
Verify that the user button on top right, says “Hello Prof”

**Test Case #7**:  User Record Copy-on-write
For efficiency, the model for TAM user propagation to member sites is copy-on-access or copy-on-write.  To test:

Follow the steps in Test Case #2 to log into the TAM site.
Click on any Roncabeanz product.
User will be take to the Roncabeanz view product page for the product that was clicked on.
Click the “Add to Cart” link for the product.
Hover over the shopping cart.
Verify that a drop menu with “View” and “Empty” is shown.
Click “View”.
From the ViewCart page, click “Purchase”.  This is a pseudo purchase which writes a purchase record.
Hover over the “Hello <user> button.
Select “Order History” from the drop-down menu.
Verify that the user purchases are shown.


**Test Case #8**:  Rating and review
The Team Alpha Market site provides an optional feature allowing users to rate products by clicking into the member site’s ratings page.  Member sites are not required to support this feature.  To test:

From the Team Alpha Market home page or the “Shop” page, look for any Roncabeanz product row.  
Click the stars above a product.
Verify that you are directed to the Ratings page for Roncabeanz.com.
Another example:
Login from Team Alpha Market place (use the account you created in Test Case #1)
look for any “Thinkin Full Stack” products with the flower image
Click the stars above the product
It will navigate to “Thinkin Full Stack” product detail page, and you can add “Rating” and “Comment” for this product. After you done, click “Add” button. The new comment will be displayed below.
 
**Test Case #9**:  all products in each member sites
Click “shop” button (yellow button) after login, you are able to view all the products in each member site. The products are displayed on an “infinite” horizontal scroll bar.
(This function is enable by each member company sharing accessible product API , e.g. http://yarnix.com/curlproduct/)
  
Test Case #10 (Bonus):  Search Products with auto-complete
A search bar is provided for user to search any product in the marketplace. For example, typing “atlantic”, two matching candidate will be shown in the dropdown. To test:

Navigate to the Team Alpha Market “Shop” page.
Click on the “Search Products” input area.
Begin typing ‘a’ then ‘t’ then ‘l’.
Note that with each letter, the search range is narrowed.
After inputting ‘atl’ there will be two choices, “Atlantic Crossing” and “Mid-Atlantic Crossing”.  Select either of these options and press <return>.
Note that TAM will redirect you to the product page in member site directly. 


For Test Case #11-13, please login as admin: 
User name:  ‘tamadmin@teamalphamarket.com’
Password:  ‘adminPassword’

**Test Case #11**:  User Activity Tracking

The TAM marketplace tracks user activity including product reviews, searches, and views.  The customer tracking data can be viewed by the administrator.  To test:

Login to TAM as admin (described above).
Hover over the “Hello TAM” on the upper right, and a menu will drop down.
Click “Show Tracking Information”. 
The “User Activity” page will be shown.  This page displays all user tracking information.
The table can be sorted by any of the columns.

**Test Case #12**: Customer management

The TAM marketplace provides a means for an administrator to view customers.  To test:

Login to TAM as admin (described above).
Hover over the “Hello TAM” on the upper right, and a menu will drop down.
Click “Manage Customers”.
The Show Customers page will be displayed.

**Test Case #13**: Customer Searches with auto completion

The TAM marketplace provides a means for an administrator to search customers by name, email, and by home or cell phone number.  To test:

Follow the steps in Test Case #10 to navigate to the Show Customers”.
Click on the input box that says “Enter Name, email, or phone number”.
Type ‘408’.  Note the autocomplete feature for phone numbers.
Backspace to remove all input.
Type li.  Note the autocomplete feature that includes names and emails.
Select ‘Lizzy Borden” and press <enter>
TAM will navigate to the Show Customer page, which will be populated for “Lizzy Borden’.
Note “Lizzy Borden” TAM activity is displayed at the bottom of the page. 

**Test Case #14**: Per-user Activity Tracking

Follow the steps of Test Case #13 to navigate to the Show Customer page for ‘Lizzy Borden’.
At the bottom of the page, note the Activity section, which has activity tracking for the user.
You can repeat this test using the user from Test Case #1 & #2.  Login as the user you created.  Search and browse products.  Login as admin and verify that the recent activity has been tracked for the user.

**Test Case #15**: Team member websites introduction

Click the “TEAM / PARTNERS” link in the top header
It will navigate to the site where introduces 6 team member websites with “title” and “short description”.
Click any “title” will link to the individual team member website HOME page.
