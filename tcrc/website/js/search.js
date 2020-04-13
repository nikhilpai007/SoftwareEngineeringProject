function search(){
  var input;
  var txtboxSearch = document.getElementById("txtSearch").value;
  if(txtboxSearch.match(/[A-Za-z0-9+#-\.]+$/))
    input = txtboxSearch;
  else
    input = "";

  var filter = getFilter();
  sessionStorage.setItem('filter',filter);

  if(input.length > 0)
    location.replace("search.php?all="+input);
  else
    alert("Your search entry is causing errors, fix me.");

}

function navSearch(){
  var input;
  var txtboxSearch = document.getElementById("navSearch").value;
  alert(txtboxSearch);
  //if(txtboxSearch.match(/[A-Za-z0-9+#-\.]+$/))
    //input = txtboxSearch;
  //else
    //input = "";

  var filter = "111111";
  sessionStorage.setItem('filter',filter);

  if(input.length > 0)
    location.replace("search.php?all="+txtboxSearch);
  else
    location.replace("search.php?all="+txtboxSearch);

}

function getFilter(){
  var filter;
  var cbAll = document.getElementById("cbAll");
  var cbProject = document.getElementById("cbProject");
  var cbStudent = document.getElementById("cbStudent");
  var cbFaculty = document.getElementById("cbFaculty");
  var cbContact = document.getElementById("cbContact");
  var cbHost = document.getElementById("cbHost");

  if(cbAll.checked == true){
    filter = "1";
  }else{
    filter = "0";
  }

  if(cbProject.checked == true){
    filter = filter+"1";
  }else{
    filter = filter+"0";
  }

  if(cbStudent.checked == true){
    filter = filter+"1";
  }else{
    filter = filter+"0";
  }

  if(cbFaculty.checked == true){
    filter = filter+"1";
  }else{
    filter = filter+"0";
  }

  if(cbContact.checked == true){
    filter = filter+"1";
  }else{
    filter = filter+"0";
  }

  if(cbHost.checked == true){
    filter = filter+"1";
  }else{
    filter = filter+"0";
  }

  return filter
}

function filterController(){
  var filter = sessionStorage.getItem('filter');
  if(filter == null){
    filter = "111111";
  }
  setFilter(filter);
}

function setFilter(filter){
  var tableProject = document.getElementById("project");
  var tableStudent = document.getElementById("student");
  var tableFaculty = document.getElementById("faculty");
  var tableContact = document.getElementById("contact");
  var tableHost = document.getElementById("host");
  var cbAll = document.getElementById("cbAll");
  var cbProject = document.getElementById("cbProject");
  var cbStudent = document.getElementById("cbStudent");
  var cbFaculty = document.getElementById("cbFaculty");
  var cbContact = document.getElementById("cbContact");
  var cbHost = document.getElementById("cbHost");

  if(filter.charAt(0) == "0"){
    cbAll.checked = false;
    cbProject.checked = false;
    cbStudent.checked = false;
    cbFaculty.checked = false;
    cbContact.checked = false;
    cbHost.checked = false;
    tableProject.style.display = "none";
    tableStudent.style.display = "none";
    tableFaculty.style.display = "none";
    tableContact.style.display = "none";
    tableHost.style.display = "none";
    if(filter.charAt(1) == "1"){
      cbProject.checked = true;
      tableProject.style.display = "block";
    }
    if(filter.charAt(2) == "1"){
      cbStudent.checked = true;
      tableStudent.style.display = "block";
    }
    if(filter.charAt(3) == "1"){
      cbFaculty.checked = true;
      tableFaculty.style.display = "block";

    }
    if(filter.charAt(4) == "1"){
      cbContact.checked = true;
      tableContact.style.display = "block";

    }
    if(filter.charAt(5) == "1"){
      cbHost.checked = true;
      tableHost.style.display = "block";
    }
  }
}

function reset(){
  document.location.replace("search.php");
  filter = "111111";
  sessionStorage.setItem('filter',filter);
}

function checkStudent() {

  var checkbox = document.getElementById("cbStudent");
  var content = document.getElementById("student");

  if (checkbox.checked == true) {
     content.style.display = "block";
   } else {
     content.style.display = "none";
   }
}

function checkProject() {
  var checkbox = document.getElementById("cbProject");
  var content = document.getElementById("project");

  if (checkbox.checked == true) {
     content.style.display = "block";
   } else {
     content.style.display = "none";
   }
}


function checkFaculty() {
  var checkbox = document.getElementById("cbFaculty");
  var content = document.getElementById("faculty");

  if (checkbox.checked == true) {
     content.style.display = "block";
   } else {
     content.style.display = "none";
   }
}


function checkHost() {
  var checkbox = document.getElementById("cbHost");
  var content = document.getElementById("host");

  if (checkbox.checked == true) {
     content.style.display = "block";
   } else {
     content.style.display = "none";
   }
}


function checkContacts() {
  var checkbox = document.getElementById("cbContact");
  var content = document.getElementById("contact");

  if (checkbox.checked == true) {
     content.style.display = "block";
   } else {
     content.style.display = "none";
   }
}


function checkAll() {
  var checkbox = document.getElementById("cbAll");
  var box1 = document.getElementById("cbProject");
  var box2 = document.getElementById("cbStudent");
  var box3 = document.getElementById("cbFaculty");
  var box4 = document.getElementById("cbContact");
  var box5 = document.getElementById("cbHost");

  if (checkbox.checked == true) {
     box1.checked = true;
     box2.checked = true;
     box3.checked = true;
     box4.checked = true;
     box5.checked = true;
     checkProject();
     checkStudent();
     checkFaculty();
     checkContacts();
     checkHost();
   } else {
     box1.checked = false;
     box2.checked = false;
     box3.checked = false;
     box4.checked = false;
     box5.checked = false;
     checkProject();
     checkStudent();
     checkFaculty();
     checkContacts();
     checkHost();
   }
}
