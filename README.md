<h1 align="center">Movie Ratings</h1>

## Prompt

"We would like a single page web application that touches on database, PHP, HTML/CSS and JavaScript/jQuery/AJAX. This app should display a small set of movies pulled from a MySQL database, each with a minimum of a title and thumbs up/down count totals. There should be a way for up- or down-voting each movie, with the votes being stored in the database. The votes should be submitted via AJAX to a middleware layer such that it is not necessary to redraw the whole page. The database should be accessed using an instance of a PHP class that manages the connection and provides methods for accessing the movie table. The developer has the freedom to implement the initial page load from either a PHP class, from JavaScript, or a combination of the two. The code should not be based on an existing PHP or JS framework (other than jQuery). CSS should be used for styling; inline styles should be avoided. The code should be structured with an eye towards maintainability."

## What is this?

This MVP project demonstrates the above prompt.
<div align="center"><img src="https://i.imgflip.com/913ar8.jpg" height="150"></div>

Therefore, this does not include:
- user access control,
- data validation,
- graceful error handling,
- films other than the Skywalker Saga,
- pagination,
- vote limiting,
- or countless other features.

## Install

- Clone the repo.
- Make the `/public` directory your document root.
- Create a database and run `database.sql` to deploy the tables & sample data.
- Enter your config info into `sample_config.php` and copy it to `config.php`.
- Good luck, have fun!
- P.S. If there are any issues, lmk thx