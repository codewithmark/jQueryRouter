# 🧭 Build a SPA in Minutes with This jQuery Router 
# (No Frameworks Needed!)

Ever wanted a simple router without diving into React or Vue? This jQuery-powered dynamic router helps you build SPAs with clean URLs, dynamic parameters, and smooth navigation—all in under 100 lines of code!

---

## 🚀 Features That Make It Awesome

* ✅ Route based on path like `/about`, `/user/42`
* ✅ Dynamic parameters (e.g., `/user/:id`)
* ✅ Automatic or manual base path detection
* ✅ Works with browser history (`pushState`)
* ✅ 404 page support
* ✅ Super lightweight — perfect for static sites!

---

## 📁 Project Structure (So Simple!)

```
project-root/
│
├── index.html        ← Your main HTML file
└── (optionally hosted in a subfolder, like /my-app/)
```

---

## 🧠 How Does It Work?

This tiny but powerful router listens for URL changes and loads content into the page without refreshing the browser. It uses the HTML5 History API and jQuery DOM manipulation for seamless page updates.

---

## 🛠️ Quick Start Guide

### 1. ✅ Load jQuery and the Router

Make sure jQuery is loaded. Add the router script in your HTML (`index.html`).

### 2. 🔧 Initialize the Router

```js
// 🟢 Option A: Auto-detect base path
const router = new Router();

// 🟢 Option B: Manually define base path
const router = new Router('/my-app/');
```

> 💡 Pro Tip: Use Option B for GitHub Pages or subdirectory hosting.

### 3. ➕ Define Your Routes

```js
router.addRoute('', () => {
  $('#app').html('<h2>Home</h2><p>Welcome!</p>');
});

router.addRoute('about', () => {
  $('#app').html('<h2>About</h2><p>This is the about page.</p>');
});

router.addRoute('user/:id', (params) => {
  $('#app').html(`<h2>User Page</h2><p>User ID: ${params.id}</p>`);
});
```

### 4. 🔁 Set a Default 404 Route

```js
router.setDefault((path) => {
  $('#app').html(`<h2>404</h2><p>Page not found: ${path}</p>`);
});
```

### 5. 🧭 Make Navigation Work

```js
$('#nav-home').click(e => {
  e.preventDefault();
  router.navigate('');
});
```

---

## 💡 Live Example

```html
<nav>
  <a href="#" id="nav-home">Home</a>
  <a href="#" id="nav-about">About</a>
  <a href="#" id="nav-user42">User 42</a>
  <a href="#" id="nav-user77">User 77</a>
</nav>
<div id="app"></div>
```

Click the links—your content updates instantly without reloading the page.

---

## 🌍 Hosting on GitHub Pages?

Deploying at:

```
https://username.github.io/my-router-project/
```

Use:

```js
const router = new Router('/my-router-project/');
```

---

## 🎯 Why Use This Router?

| Feature             | Why You’ll Love It                       |
| ------------------- | ---------------------------------------- |
| **No frameworks**   | Just jQuery — fast and beginner-friendly |
| **Dynamic routes**  | URLs like `/user/:id` made easy          |
| **404 support**     | Catch-all fallback for unknown paths     |
| **Base path ready** | Works on subfolders & GitHub Pages       |
| **Tiny footprint**  | Easy drop-in for any static site         |

---

## 🧰 Perfect For:

* Static sites with multiple views
* Demos, portfolios, and prototypes
* GitHub Pages-hosted SPAs
* Beginners learning about routing

---

## 📚 Take It Further

* Add routes like `/contact`, `/products/:id`, etc.
* Load content dynamically with AJAX.
* Style links to show active pages.

---

## 🤝 Want to Contribute?

Fork, clone, and submit a pull request!

 

---

🔥 If you found this helpful, star the repo and share it with others looking to build fast, framework-free SPAs!
