// From this Awesome GIST: https://gist.github.com/agnoster/6e38a1c595102e892381

AsanaApi = (function() {

// Adapted from http://www.nczonline.net/blog/2010/05/25/cross-domain-ajax-with-cross-origin-resource-sharing/
function createCORSRequest(method, url) {
  var xhr = new XMLHttpRequest()
  if ("withCredentials" in xhr) {
    xhr.open(method, url, true)
  } else if (typeof XDomainRequest != "undefined") {
    xhr = new XDomainRequest()
    xhr.open(method, url)
  } else {
    throw new Error("CORS not supported by browser")
  }
  return xhr
}

function authorizationHeader(options) {
  if (options.api_key) return "Basic " + btoa(options.api_key + ":")
  if (options.token) return "Bearer " + options.token
  throw new Error("Unknown authorization type, specify api_key or token")
}

function AsanaApi(options) {
  options = options || {}
  this.host = options.host || "app.asana.com"
  this.root = options.root || "https://" + this.host + "/api/1.0"
  this.authorization = authorizationHeader(options)
}

AsanaApi.prototype.request = function(method, path, cb) {
  var xhr = createCORSRequest(method, [this.root, path].join("/"))

  xhr.setRequestHeader("Authorization", this.authorization)

  xhr.onreadystatechange = function() {
    if (xhr.readyState !== 4) return
    var response = JSON.parse(xhr.response)
    if (xhr.status < 400) {
      cb(null, response)
    } else {
      cb(response)
    }
  }

  xhr.send()
}

return AsanaApi

})()