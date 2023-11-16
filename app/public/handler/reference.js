function sendSelect(id){
  const xhr = new XMLHttpRequest();
  xhr.open('POST','../../api/reference/select.php', true);
  xhr.onload = function(){
    if (this.status == 200){
      let response = JSON.parse(this.responseText);
      console.log(this.responseText);
      const data = response.message[0];
      const ref_code = data.referral_code;
      const point = data.point;
      document.getElementById("ref_code").innerHTML = ref_code;
      document.getElementById("point").innerHTML = point;
    }
  }
  xhr.send(JSON.stringify({"id": id}));
}

function sendSelectAllLimit(limit, offset){
  const xhr = new XMLHttpRequest();
  xhr.open('POST','../../api/reference/select_many.php', true);
  console.log(limit, offset);
  xhr.onload = function(){
    if (this.status == 200){
      let response = JSON.parse(this.responseText);
      const data = response.message;
      for (let i = 0; i < data.length; i++){
        if (data[i]){
          document.getElementById("id_"+i).innerHTML = data[i].id;
          document.getElementById("aa_id_"+i).innerHTML = data[i].anime_account_id;
          document.getElementById("fa_id_"+i).innerHTML = data[i].forum_account_id == 0 ? "-" : data[i].forum_account_id  ;
          document.getElementById("ref_code_"+i).innerHTML = data[i].referral_code;
          document.getElementById("point_"+i).innerHTML = data[i].point;
        } else {
          document.getElementById("row_"+i).style.display = "none";
          document.getElementById("btn_"+i).style.display = "none";
        }

      }

    }
  }
  
  xhr.send(JSON.stringify({"limit" : limit, "offset" : offset ?? 0}));
}

function sendInsertMany(many_id){
  const xhr = new XMLHttpRequest();
  xhr.open('POST','../../api/reference/create_many.php', true);
  xhr.onload = function(){
    if (this.status == 200){
      let response = JSON.parse(this.responseText);
      alert("Successfully insert many data");
    }
  }
  xhr.send(JSON.stringify({"many_id": many_id}));
}

function sendInsert(id, type){
  const xhr = new XMLHttpRequest();
  xhr.open('POST','../../api/reference/create.php', true);
  xhr.onload = function(){
    if (this.status == 200){
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      alert(response.message);
    }
  }
  xhr.send(JSON.stringify({"id": id}));

  if (type == 'admin'){
    window.location.replace("/?admin/client/page=1");
  } else if (type == 'signup'){
    window.location.replace("/?login");
  }

}

function sendDelete(id, page){
  const xhr = new XMLHttpRequest();
  console.log(id);
  xhr.open('POST','../../api/reference/delete.php', true);
  xhr.onload = function(){
    if (this.status == 200){
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      alert(response.message);
    }
  }
  xhr.send(JSON.stringify({"id": id}));

  window.location.replace("/?admin/client/page="+page);

}


function sendUpdatePoint(id, anime_id, point){
  const xhr = new XMLHttpRequest();
  xhr.open('POST','../../api/reference/edit.php', true);
  xhr.onload = function(){
    if (this.status == 200){
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      alert("List has been changed. " + response.message);
    }
  }
  xhr.send(JSON.stringify({"type": "point", "anime_id": id, "point" :point}));

  window.location.replace("/?anime/detail/"+anime_id)
}