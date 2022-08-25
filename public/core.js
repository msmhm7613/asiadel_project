function add_attr(){
    $('#div_attr').append('<div><div class="col-md-5"><input class="form-control" name="key[]" placeholder="عنوان"></div>' + 
    '<div class="col-md-5"><input class="form-control" name="value[]" placeholder="مقدار"></div>' + 
    '<div class="col-md-2"><button type="button" class="btn btn-sm" onclick="remove_row(this)">-</button></div></div>');
}

function remove_row(e){
    $(e).parent().parent().remove();
}