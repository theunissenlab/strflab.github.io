function Form(id) {
    this.obj = typeof(id) == "string"?document.getElementById(id):id
    this.type = this.obj.tagName == "textarea" ? "textarea":this.obj.type
    this.name = this.obj.id[0].toUpperCase()+this.obj.id.substr(1)
    this.classes = this.obj.className
    
    var thisObj = this
    this.obj.onfocus = function() { thisObj.focus() }
    this.obj.onblur = function() { thisObj.blur() }
    this.obj.js = this
    this.blur()
}

Form.prototype.focus = function() {
    if (this.obj.value == this.name) {
        this.obj.value = ""
        this.obj.className = this.classes
        this.obj.focus()
    }
}

Form.prototype.blur = function () {
    if (this.obj.value == "" || this.obj.value == this.name) {
        this.obj.value = this.name
        this.obj.className = this.classes + " formBlur"
    }
}
Form.prototype.filled = function() {
    return this.obj.value != this.name
}

function makeForms() {
    var forms = document.getElementsByTagName("form")
    for (var i = 0; i < forms.length; i++ ) {
        var els = forms[i].getElementsByTagName("input")
        for (var j = 0; j < els.length; j++)
            if (els[j].type == "text")
                new Form(els[j])
        
        var els = forms[i].getElementsByTagName("textarea")
        for (var j = 0; j < els.length; j++)
            new Form(els[j])
        
    }
}
