/** Copy to Clipboard **/
function copytoclipbrd(id,etype) {
	// Get the text field
	var copyText = document.getElementById(id);

	if (etype=="value") {
		// Select the text field
		copyText.select();
		copyText.setSelectionRange(0, 99999); // For mobile devices

		// Copy the text inside the text field
		navigator.clipboard.writeText(copyText.value);

		// Alert the copied text
		// alert("Copied the text: " + copyText.value);
	} else {
		// Copy the text inside the text field
		navigator.clipboard.writeText(copyText.innerHTML);

		// Alert the copied text
		// alert("Copied the text: " + copyText.innerHTML);
	}	
}