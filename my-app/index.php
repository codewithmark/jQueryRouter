<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>jQuery Dynamic Router with Base Path</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      font-family: sans-serif;
      margin: 2rem;
    }
    nav a {
      margin-right: 15px;
      text-decoration: none;
      color: blue;
      cursor: pointer;
    }
    nav a:hover {
      text-decoration: underline;
    }
    #app {
      margin-top: 2rem;
    }
  </style>
</head>
<body>


  <script>
    class Router {
      constructor(basePath = null) {
        this.routes = [];
        this.defaultRoute = null;

        if (basePath) {
          // Use manually provided base path
          this.base = basePath.replace(/\/+$/, '') + '/';
        } else {
          // Auto-detect base path
          const scripts = document.getElementsByTagName('script');
          const currentScript = scripts[scripts.length - 1].getAttribute('src') || '';
          const url = new URL(currentScript, window.location.href);

          const currentPath = window.location.pathname.split('/');
          const scriptPath = url.pathname.split('/');

          let baseParts = [];
          for (let i = 0; i < currentPath.length; i++) {
            if (currentPath[i] === scriptPath[i]) break;
            baseParts.push(currentPath[i]);
          }

          this.base = baseParts.join('/') + '/';
        }

        console.log('Router base path:', this.base);
      }

      addRoute(pattern, callback) {
        const fullPattern = this._normalizePath(pattern);
        const paramNames = [];
        const regex = new RegExp(
          '^' + fullPattern
            .replace(/\/:([^\/]+)/g, (_, name) => {
              paramNames.push(name);
              return '/([^/]+)';
            }) + '$'
        );
        this.routes.push({ regex, callback, paramNames });
      }

      setDefault(callback) {
        this.defaultRoute = callback;
      }

      navigate(path) {
        const fullPath = this._normalizePath(path);
        history.pushState({}, '', fullPath);
        this._loadRoute(fullPath);
      }

      _normalizePath(path) {
        return this.base + path.replace(/^\/+/, '');
      }

      _getCurrentPath() {
        return window.location.pathname;
      }

      _loadRoute(path = null) {
        const currentPath = path || this._getCurrentPath();

        for (const route of this.routes) {
          const match = currentPath.match(route.regex);
          if (match) {
            const params = {};
            route.paramNames.forEach((name, i) => {
              params[name] = match[i + 1];
            });
            route.callback(params);
            return;
          }
        }

        if (this.defaultRoute) {
          this.defaultRoute(currentPath);
        }
      }

      start() {
        window.addEventListener('popstate', () => {
          this._loadRoute();
        });
        this._loadRoute(this._getCurrentPath());
      }
    }

    $(document).ready(function () {

      // 🟢 Option A: auto-detect
      // const router = new Router();

      // 🟢 Option B: manually specify folder path      
      const router = new Router('/my-app/'); // ← change if needed

      router.addRoute('', () => {
        $('#app').html('<h2>Home Page</h2><p>Welcome to the home page!</p>');
      });

      router.addRoute('about', () => {
        $('#app').html('<h2>About Page</h2><p>This is the about page.</p>');
      });

      router.addRoute('user/:id', (params) => {
        $('#app').html(`<h2>User Page</h2><p>User ID: ${params.id}</p>`);
      });

      router.setDefault((path) => {
        $('#app').html(`<h2>404 Not Found</h2><p>No route for: ${path}</p>`);
      });

      router.start();

      $('#nav-home').click(e => {
        e.preventDefault();
        router.navigate('');
      });

      $('#nav-about').click(e => {
        e.preventDefault();
        router.navigate('about');
      });

      $('#nav-user42').click(e => {
        e.preventDefault();
        router.navigate('user/42');
      });

      $('#nav-user77').click(e => {
        e.preventDefault();
        router.navigate('user/77');
      });
    });
  </script>



  <nav>
    <a href="#" id="nav-home">Home</a>
    <a href="#" id="nav-about">About</a>
    <a href="#" id="nav-user42">User 42</a>
    <a href="#" id="nav-user77">User 77</a>
  </nav>

  <div id="app"></div>

</body>
</html>
