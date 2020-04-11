
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CSS Expanding Hamburger Menu Demo</title>
<style>


body {
  font-family: 'Roboto', cursive;
  text-align: center;
}

a {
  color: white;
  text-decoration: none;
}

.checkbox-trigger {
  opacity: 0;
  position: absolute;
  width: 50px;
  height: 50px;
  left: 0px;
}

.hamburger-menu, .hamburger-menu::before, .hamburger-menu::after {
  display: block;
  position: absolute;
  background: white;
  width: 40px;
  height: 4px;
  margin: 1.3em 3em;
  transition: background 0.3s;
}

.hamburger-menu::before, .hamburger-menu::after {
  content: '';
  position: absolute;
  margin: -0.7em 0 0;
  transition: width 0.7s ease 0.3s, transform 0.7s ease 0.3s;
}

.hamburger-menu::after { margin-top: 0.7em; }

.hamburger-menu {
  position: relative;
  display: block;
  margin: 0;
  margin-top: 1.45em;
  margin-right: 0.35em;
  margin-left: 0.35em;
  margin-bottom: 1.45em;
  transition: width 0.3s ease;
}

.checkbox-trigger:checked { left: 202px; }

.checkbox-trigger:checked + .menu-content .hamburger-menu {
  width: 2em;
  transition: width 0.7s ease 0.7s;
}

.checkbox-trigger:checked + .menu-content .hamburger-menu::before {
  width: 1.2em;
  transform: rotate(-35deg);
  margin-top: -0.4em;
}

.checkbox-trigger:checked + .menu-content .hamburger-menu::after {
  width: 1.2em;
  transform: rotate(35deg);
  margin-top: 0.4em;
}

.checkbox-trigger:checked + .menu-content ul {
  width: 200px;
  height: 640px;
  transition: width 0.7s ease 0.3s, height 0.3s ease;
}

.menu-content {
  display: flex;
  background: #048B9A;
  color: white;
  float: left;
}

.menu-content ul {
  display: block;
  padding-left: 0;
  padding-top: 1em;
  padding-bottom: 1em;
  margin: 0;
  width: 0px;
  height: 0px;
  overflow: hidden;
  transition: height 0.3s ease 0.7s, width 0.7s ease;
}

.menu-content ul li {
  list-style: none;
  padding-top: 1em;
  padding-bottom: 1em;
  cursor: pointer;
  transition: color 0.5s, background 0.5s;
}

.menu-content ul li:hover {
  color: #0CD6AD;
  background: #1E332F;
}
h1 { color:#fff; padding:70px 0;}
</style>
</head>

<body>
  <input class="checkbox-trigger" type="checkbox"  />
  <span class="menu-content">
    <ul>
    <li><a href="#">PS4</a></li>
      <li><a href="#">PS3</a></li>
      <li><a href="#">PS2</a></li>
      <li><a href="#">XBOX ONE X</a></li>
      <li><a href="#">XBOX ONE S</a></li>
      <li><a href="#">XBOX 360</a></li>
      <li><a href="#">SWITCH</a></li>
      <li><a href="#">WII U</a></li>
      <li><a href="#">WII</a></li>
      <li><a href="#">PC</a></li>
      <li><a href="#">MAC</a></li>
      <li><a href="#">AUTRE</a></li>
    </ul>
  <span class="hamburger-menu"></span>
  </span>

</body>
</html>
