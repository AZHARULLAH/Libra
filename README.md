Libra is one place online destination where you can compare price deals of a product from different online shopping sites and buy them directly. At present Libra supports comparision of a product from only Amazon and Flipkart. This is under development and when complete we can compare any two or more online shopping sites. This website is developed mainly as a project to qualify SV.CO application process.

The core of the website lies in the optimal and efficient use of the API's provided by various e-commerce sites. The uniqueness of the website lies in the fact that there is no database being used to store anything. Everything is being fetched on demand from the servers as and when required. The selected product is fetched and matched with products from other websites using a efficient and accurate algorithm. Even the brands and price for a search results are not hard-coded, but are dynamically extracted from the data sent by the servers on demand.

For search, Flipkart and Amazon API's are being used. For categories, Flipkart API and for comparision, Flipkart and Amazon API's are being used. For deals, Flipkart, Amazon and Infibeam API's are used. For styling the pages, Materialize CSS, a framework by google are being used. Another framework used is jQuery. Libraries being used are noUiSlider for price filter, bootstrap, preloaderjs for page preloading effects, hover and ihover for general hovering effects.

The search is limited to only Flipkart and Amazon as these two are the only sites providing the search API. Details from other sites like Infibeam, Snapdeal, Shopclues, etc. can be fetched using further complicated techniques like web scraping, but these methods haven't been explored because of the time constraint. The other websites would be definitely incorporated soon.

Features of the website :

1) User can either search products by category or directly search for the product via the search bar provided in every page of the site.

2) The search results are very accurate as they are the same results you would find when you search any other e-commerce sites.

3) Users can also find highly discounted products from various sites from a dedicated page for deals, which can be accessed from any page in the website. This is an extra feature of the website, apart from the features specified.

4) Search by categotry is also an extra feature of the website, apart from the features specified.

5) There are also bonus features like filtering the products based on the brands and price, sorting the products based on relevance and price(both low to high and high to low).

6) Once a product is selected, user gets the prices of the product from different sites and shows a tabular-like comparision of the product from different sites.

7) The site is made keeping the point in view that the common man should be able to use it with ease. Hence, there has been an attempt to keep the interface as simple as possible throughout the site.

Limitations of the website :

1) This website was developed by a group of college students primarily as a project to qualify SV.CO application process. So it might have some issues owing to our time target and our college schedules.

2) This site is best viewed in a Windows or a Mac OSX machine. Has a few styling issues in Linux systems.

3) The site appears a little hazy on a mobile phone (issues will be sorted out soon).

4) The site might rarely become unresponsive. Refreshing the page would again get it back to working (this is because there are lot of background operations going on). 

5) Even though a very efficient algorithm is being used to match products obtained from various sites, there might be some inaccuracy in matching the products. This could be because of various reasons: One is that the ranking of products in various websites is very different. Also, a few categories of products are available only on a few websites.

6) There are a lot of processes being run in the background, the application requires to have a decent internet connection. The time taken to load the page would depend on the connection.

7) The browsing experience is the best in chrome as the other browsers might not support all animations and transitions.

8) The application is deployed in heroku, where the php mail server is not supported. So the form functionality is removed.
