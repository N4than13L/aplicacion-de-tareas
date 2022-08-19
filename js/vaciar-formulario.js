function limpiarFormulario() {
    document.getElementById("txtTareaTitulo").value = "";
    document.getElementById("taDescripcion").value = "";

    var url = window.location.toString();
    
    if (url.indexOf("?") > 0) {
        var clean_url = url.substring(0, url.indexOf("?"));
        window.history.replaceState({}, document.title, clean_url);
  }
}