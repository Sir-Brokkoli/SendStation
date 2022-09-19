# Sendstation

The Sendstation project is a web application supporting a small climbing competition in the 
proximity area of Innsbruck. What started as a personal project to study php-programming as
well as HTML, JavaScript and SQL soon became a serious thing.

## The project

Essentially, the idea behind this project is to provide a supportive platform for a climbing
competition. This plattform is given in the form of a web application any potential user can
sign up to. A logged in user can register climbing sessions in the crags listed in the database
and add goes to the routes the user climbed. Hereby, not only the success of the attempt is
registered but also the amount of falls. This data will be used to give away prices not only
to those climbing the strongest but also those triing the hardest.

## Technical details

This personal resembles a web application mainly written in php-scripts and HTML-forms. The
Bootstrap-Framework, a combination of css- and JavaScript-library, is used for the frontend
developement. As backend technology a relational MariaDB Mysqli database is used.

The main architechture of the project is layered in backend, business logic and frontend 
layers. However, this architecture will in future be altered to a feature based architecture
which resembles these layers in each feature seperately. This allows for better scaleability
as well as maintainability for further developement. To render this possible, all core 
components will get clear and intuitive interfaces. Inter-component communication will be 
mostly organized via the event-listener-pattern. This way, different components can still
viably communicate without breaking unidirectional dependencies.

## Further developement

In near future, several new features are planed for implementation:
- [ ] a follower-followee system as a base for (next point)
- [ ] a belayer- registering system which allows to add the belying climber to the data of 
  each climbing attempt and (next point)
- [ ] a newsticker with infos about your followees' progress.
- [ ] a reward system giving badges for different achievements (having x falls, tried same
  route x times, climbed x routes of a specific grade,...).
- [ ] a better security concept.
- [ ] improvement in the layout for better usability.
