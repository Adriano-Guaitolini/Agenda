function data(i, mes, ano){
   document.form.data.value = (i + "/" + mes + "/" + ano);
}


function revelarCadastro(){
   let revelar = document.querySelector(".FormCadastro");
   revelar.classList.add("MostrarForm");
}
function revelarEditar(){
   let revelar = document.querySelector(".FormEditar");
   revelar.classList.add("MostrarForm");
}
function fecharCadastro(){
   let revelar = document.querySelector(".FormCadastro");
   revelar.classList.remove("MostrarForm");
}
function fecharEditar(){
   let revelar = document.querySelector(".FormEditar");
   revelar.classList.remove("MostrarForm");
}
function dataRef(id,data,compromisso,descricao){
   document.forms["formUpdate"]["id"].value = id;
   document.forms["formUpdate"]["data"].value = data;
   document.forms["formUpdate"]["compromisso"].value = compromisso;
   document.forms["formUpdate"]["descricao"].value = descricao;
}


