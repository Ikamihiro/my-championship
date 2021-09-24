const express = require("express");
const path = require("path");
const hbs = require("hbs");
const port = process.env.PORT || 3000;

const app = express();
app.set("view engine", "hbs");
app.set("views", path.join(__dirname, "pages"));
app.use(express.static(path.join(__dirname, "public")));

hbs.registerHelper("section", function (name, options) {
  if (!this._sections) this._sections = {};
  this._sections[name] = options.fn(this);
  return null;
});

app.get("/", function (req, res) {
  res.render("index");
});

app.get("/login", function (req, res) {
  res.render("login", {
    layout: 'auth',
  });
});

app.get("/register", function (req, res) {
  res.render("register", {
    layout: 'auth',
  });
});

app.get("/partidas", function (req, res) {
  res.render("partidas");
});

app.get("/campeonatos", function (req, res) {
  res.render("campeonatos");
});

app.listen(port);

console.log("Server started at http://localhost:" + port);
