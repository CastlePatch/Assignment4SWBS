function validate(){
	title = document.getElementById("title").value;
	content = document.getElementById("content").value;
	error = validateTitle(title);
	error += validateContent(content);

	if(!error)
		return true;
	else
		document.getElementById("error").innerHTML = error;
	return false;
}

function validateTitle(title){
	errors = "";
	if(title.length > 50){
		errors = "Title should be less than 50 characters.<br>"
	}
	if(title.length == 0)
		errors = "Title cannot be empty.<br>"
	return errors;
}

function validateContent(content){
	errors = "";
	if(content.length > 1000){
		errors = "Content should be less than 1000 characters.<br>"
	}
	if(content.length == 0)
		errors = "Content cannot be empty.<br>"
	return errors;
}