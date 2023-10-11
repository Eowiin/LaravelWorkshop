
function getCurrentURL () {
    return window.location.href
}

function changePage(page) {
    url = getCurrentURL();
    route = window.location.href.split("?")[0];
    params = window.location.href.split("?")[1];

    params = params.split("&")
    for (let i = 0; i < params.length; i++) {
        if (params[i].includes("page="))
            params[i] = "page=" + page;
    }
    params = "?" + params.join("&");
    window.location.href = route + params;
}

const addPostBtn = document.getElementById('add-post-btn');

function openAddPostModal() {
  console.log('openAddPostModal');
  document.getElementById('add-post-modal').style.display = 'block';
}

console.log('Loaded ads.js')
