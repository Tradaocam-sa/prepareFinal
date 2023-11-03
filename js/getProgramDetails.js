function getHtml(result){
  let x=``;
  x=x + `<div><button class="btn btn-primary" id="button__addNew">ADD NEW</button></div>` 
  x=x + `<table class="table table-striped">`;
  let i = 0;
  for(i = 0; i< result.length; i++){
    if(i==0)
    {
      x=x+`
      <thead>
      <th>
        SLNO
      </th>
      <th>
        CODE
      </th>
      <th>
        TITLE
      </th>
      <th>
        DEPT
      </th>
      <th>Sem</th><th>GRDTIN_LVL</th><th>TECH_LV</th>
      <th></th>
      </thead><tbody>`;

    }
    //     pd.id as pid,
    // pd.code as pcode,
    // pd.title as ptitle,
    // pd.no_of_sem as nos,
    // pd.technical_level as tl,
    // pd.graduation_level as gl,
    // pd.department_id as did,
    // dd.title as dtitle,
    // dd.code as dcode
    x=x+`
      <tr>
      <td>
        ${i+1}
      </td>
      <td>
        ${result[i]['pcode']}
      </td>
      <td>
        ${result[i]['ptitle']}
      </td>
      <td>
        ${result[i]['dtitle']}
      </td>
      <td>
        ${result[i]['nos']}
      </td>
      <td>
        ${result[i]['tl']}
      </td>
      <td>
        ${result[i]['gl']}
      </td>
      <td>
        <button class="btn btn-primary">EDIT</button>
      </td>
      </tr>`;
  }
  x=x+`</tbody></table>`;
  return x;
}

function getProgramDetails()
{
  $.ajax({
    url:"/sms/ajax/getProgramDetailsAjax.php",
    type: "POST",
    dataType:"JSON",
    data:{
      a:"21",
      b:"flower",
      action1:"getProgramDetails"
    },
    beforeSend:function(){
      // alert("about to make an ajax call");
    },
    success:function(result){
      let x = JSON.stringify(result);
      
      let html= getHtml(result);
      $("#contentdiv").html(html);
    },
    error:function(){alert("Error");}

  });
}

function getSelectBox(result) {
  let x= ``;
  x=x+`<option value=-1>"SELECT ONE"</option>`
  let i = 0;
  for(i=0; i<result.length;i++)
  {
    x=x+`<option value=${result[i].did}>${result[i].dtitle}</option>`
  }
  return x;
}

function loadDepartment() {
  $.ajax({
    url:"/sms/ajax/getProgramDetailsAjax.php",
    type: "POST",
    dataType:"JSON",
    data:{
      action1:"getDepartmentDetails"
    },
    beforeSend:function(){
      // alert("about to make an ajax call");
    },
    success:function(result){
      let x = JSON.stringify(result);
      // alert(x);
      let html=getSelectBox(result);
      $("#department").html(html);
    },
    error:function(){alert("Error");}
  })
}

function passToServer(code,title,nos,department, techLevel,gradLevel){
  $.ajax(
    {
    url:"/sms/ajax/getProgramDetailsAjax.php",
    type: "POST",
    dataType:"JSON",
    data:{
      code:code,
      title:title,
      nos:nos,
      department:department,
      techLevel:techLevel,
      gradLevel:gradLevel,
      action1:"saveData"
    },
    beforeSend:function(){
      // alert("about to make an ajax call");
    },
    success:function(result){
      let x = JSON.stringify(result);
      // alert(x);
      let html=getSelectBox(result);
      $("#deparment").html(html);
    },
    error:function(){alert("Error");}
    }
  )
}

$(document).ready(
  function(){
    // alert("Jquery loaded");
    getProgramDetails();
    loadDepartment();
    $(document).on("click", "#button__addNew", () => {
      
      $("#modalProgram").modal('show');
    });
    $(".btn-danger").click(() => {
      $("#modalProgram").modal("hide");
    });
    $(document).on("click", "#save", () => {
      let code=$("#code").val();
      let title=$("#title").val();
      let nos=$("#nos").val();
      let department=$("#department").val();
      let techLevel=$("#techLevel").val();
      let gradLevel=$("#gradLevel").val();

      if(code!='' && title!='' && nos!='' && department>=0){
        passToServer(code,title,nos,department, techLevel,gradLevel);
      }
      else{
        alert(code);
        alert(title);
        alert(nos);
        alert(department);
        alert(techLevel);
        alert(gradLevel);
        alert("Invalid input");
      }
    })
    $(document).on("keypress", "#nos", (e) => {
      if(!(e.keyCode>=48 && e.keyCode<=57))
      {
        e.preventDefault();
      }
    })
  }
)