const checkIsNavigationSupported = () => {
    return Boolean(document.startViewTransition);
  }
  
  const fetchPage = async (url) => {
    // Let's load the target page using a fetch to get the HTML
    const response = await fetch(url);
    const text = await response.text();
    // Keep only the html content inside the body tag use a regex to extract it
    const [, data] = text.match(/<body>([\s\S]*)<\/body>/i)
    return data
  }
  
  export const startViewTransition = () => {
    if (!checkIsNavigationSupported()) return;
  
    debugger;
    window.navigation.addEventListener('navigate', (event) => {
      const toUrl = new URL(event.destination.url);
  
      // Is it an external page? if so, we ignore it.
      if (location.origin !== toUrl.origin) return;
  
      // If it is a navigation in the same domain (source) 
      event.intercept({
        async handler () {
          const data = await fetchPage(toUrl.pathname);
  
          // Use the view transition API
          document.startViewTransition(() => {
            // Scroll all the way up
            document.body.innerHTML = data;
            document.documentElement.scrollTop = 0;
          })
        }
      })
    })
  }