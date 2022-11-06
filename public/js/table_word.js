/* HTML to Microsoft Word Export Demo
 * This code demonstrates how to export an html element to Microsoft Word
 * with CSS styles to set page orientation and paper size.
 * Tested with Word 2010, 2013 and FireFox, Chrome, Opera, IE10-11
 * Fails in legacy browsers (IE<10) that lack window.Blob object
 */
window.export.onclick = function () {
    if (!window.Blob) {
        alert("Your legacy browser does not support this action.");
        return;
    }

    var html, link, blob, url, css;

    // EU A4 use: size: 841.95pt 595.35pt;
    // US Letter use: size:11.0in 8.5in;

    css =
        "<style>" +
        "@page WordSection1{size: 841.95pt 595.35pt;mso-page-orientation: landscape;}" +
        "div.WordSection1 {page: WordSection1;}" +
        "table{border-collapse:collapse;}td{border:1px gray solid;width:5em;padding:2px;}" +
        "</style>";

    html = window.docx.innerHTML;
    blob = new Blob(["\ufeff", css + html], {
        type: "application/msword",
    });
    url = URL.createObjectURL(blob);
    link = document.createElement("A");
    link.href = url;
    // Set default file name.
    // Word will append file extension - do not add an extension here.
    link.download = "Document";
    document.body.appendChild(link);
    if (navigator.msSaveOrOpenBlob)
        navigator.msSaveOrOpenBlob(blob, "Document.doc"); // IE10-11
    else link.click(); // other browsers
    document.body.removeChild(link);
};
