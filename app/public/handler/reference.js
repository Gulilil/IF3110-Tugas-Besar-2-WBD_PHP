function sendInsertMany(many_id){
  const xhr = new XMLHttpRequest();
  xhr.open('POST','../../api/reference/create_many.php', true);
  xhr.onload = function(){
    if (this.status == 200){
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      alert(response.message);
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
      alert(response.message);
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
  xhr.open('POST','../../api/reference/update.php', true);
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
  xhr.open('POST','../../api/reference/update.php', true);
  xhr.onload = function(){
    if (this.status == 200){
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      alert(response.message);
    }
  }
  xhr.send(JSON.stringify({"type": "unlink", "forum_id": fid, "anime_id": aid}));
}

function sendUpdatePoint(fid, aid, point){
  const xhr = new XMLHttpRequest();
  xhr.open('POST','../../api/reference/update.php', true);
  xhr.onload = function(){
    if (this.status == 200){
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      alert(response.message);
    }
  }
  xhr.send(JSON.stringify({"type": "point", "forum_id": fid, "anime_id": aid, "point" :point}));
}