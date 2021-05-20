<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body>
<nav class="nav fixed-top bg-dark">
  <a id="jobless_link" onmouseover="choice_field(this,'Jobless')" class="nav-link text-primary">Безработный</a>
  <a id="stipend_link" onmouseover="choice_field(this,'Stipend')" class="nav-link text-primary">Пособие</a>
  <a id="organization_link" onmouseover="choice_field(this,'Organization')" class="nav-link text-primary">Организация</a>
  <a id="program_link" onmouseover="choice_field(this,'Program')" class="nav-link text-primary">Образовательная программа</a>
  <a id="group_link" onmouseover="choice_field(this,'Group')" class="nav-link text-primary">Образовательная группа</a>
  <a id="passage_link" onmouseover="choice_field(this,'Passage')" class="nav-link text-primary">Прохождение обучения</a>
</nav>
<nav class="nav fixed-bottom text-black">
  <h6 class="font-weight-bold ml-auto mr-auto">Биржа труда</h6>
</nav>
<br>
<ul id="choice_list" class="list-group bg-dark mt-0" style="border-bottom-left-radius:7px;border-bottom-right-radius:5px;width:15%;display:none;position:absolute;">
  <br><a id="create_choice" class="list-group-item text-light bg-dark">Создать</a>
  <a id="update_choice" class="list-group-item text-light bg-dark">Редактировать</a>
  <a id="detail_choice" class="list-group-item text-light bg-dark">Детализировать</a>
  <a id="list_choice" class="list-group-item text-light bg-dark">Список</a>
  <input id="choice_id" class="text-light bg-dark" style="width:100%;padding-left:20px;" type="text" name="id" placeholder="Идентификатор">;
</ul>
<br>
</body>
<script src="script.js"></script>