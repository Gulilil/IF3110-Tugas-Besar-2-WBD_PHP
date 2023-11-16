function sendSelect(id){
  const xhr = new XMLHttpRequest();
  xhr.open('POST','../../api/reference/select.php', true);
  xhr.onload = function(){
    if (this.status == 200){
      let response = JSON.parse(this.responseText);
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
      console.log(data);
    }
  }
  xhr.send(JSON.stringify({"limit" : limit, "offset" : offset}));
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

function sendInsert(id){
  const xhr = new XMLHttpRequest();
  xhr.open('POST','../../api/reference/create.php', true);
  xhr.onload = function(){
    if (this.status == 200){
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      alert("Successfully insert data");
    }
  }
  xhr.send(JSON.stringify({"id": id}));
}

function sendDelete(id){
  const xhr = new XMLHttpRequest();
  xhr.open('POST','../../api/reference/delete.php', true);
  xhr.onload = function(){
    if (this.status == 200){
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      alert(response.message);
    }
  }
  xhr.send(JSON.stringify({"id": id}));
}

function sendUpdateLink(fid, aid){
  const xhr = new XMLHttpRequest();
  xhr.open('POST','../../api/reference/edit.php', true);
  xhr.onload = function(){
    if (this.status == 200){
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      alert(response.message);
    }
  }
  xhr.send(JSON.stringify({"type": "link", "forum_id": fid, "anime_id": aid}));
}

function sendUpdateUnlink(fid, aid){
  const xhr = new XMLHttpRequest();
  xhr.open('POST','../../api/reference/edit.php', true);
  xhr.onload = function(){
    if (this.status == 200){
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      alert(response.message);
    }
  }
  xhr.send(JSON.stringify({"type": "unlink", "forum_id": fid, "anime_id": aid}));
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