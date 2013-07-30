symfony2-boolean-bundle
=======================

A bundle to change the default rendering of booleans.

Rationale
---------
By default, booleans will be rendered to a checkbox, and by default, all fields are required. This is - in my opinion - not optimal:

1. A required checkbox will force the user to answer "yes", which defeats the whole purpose of asking, if the user cannot answer "no" anyway.
2. A non-required checkbox that gets submitted without being checked does not really tell you whether the user actually read the question and answered "no", or just clicked the submit button.
3. A required choice/radio with the choices "No"/"Yes" will usually start with the first answer selected, posing the same problem as 2.

Solution
-----------
1. A non-required choice will start with a blank value, followed by the two values "No" and "Yes". This is a lot better, since now there is a difference between "didnt answer" and "answered no".
2. A required choice can have a blank value aswell, but thanks to the html5 "required" attribute, most browsers will reject submitting with the blank selected, forcing the user to actually pick "yes" or "no", without providing a default.

What does this package do
-------------------------------------
This package will render all booleans as "Please choose" / "No / "Yes" boxes, providing a clean difference between "didnt read" and "answered no".
Additionally, it will infer the form's "required" attribute (which gets passed through to html) from the databases "this column is nullable" property.

What happens if the client ignores html5 required
----------------------------------------
If the clients actually submits a '1' or a '0', nothing special happens - the value gets submitted, business as usual. But if he submits a blank string, the query builder will try to insert a null value. But, because you built your database hand-in-hand with your application (right?), the required boolean field will be configured "not null". So your database will throw an error along the lines of "null is not allowed here", not accept the invalid data, and since you enclosed the whole thing in a transaction (you did, right?) nothing bad ever happened to your data.
