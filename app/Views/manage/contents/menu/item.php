<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="float-left">Menu</h5>
                <div class="float-right">
                    <button id="btnReload" type="button" class="btn btn-outline-secondary">
                        <i class="fa fa-play"></i> Load Data</button>
                </div>
            </div>
            <div class="card-body">
                <ul id="myEditor" class="sortableLists list-group">
                </ul>
            </div>
        </div>
        <p>Click the Output button to execute the function <code>getString();</code></p>
        <div class="card">
            <div class="card-header">JSON Output
                <div class="float-right">
                    <button id="btnOutput" type="button" class="btn btn-success"><i class="fas fa-check-square"></i> Output</button>
                </div>
            </div>
            <form method="post" action="<?= base_url().'/manage/menu/updateitem'?>">
                <input type="hidden" name="menu_id" value="<?= $menu->id?>">
                <div class="card-body">
                    <div class="form-group"><textarea id="out" class="form-control" name="json" cols="50" rows="10"></textarea>
                    </div>
                </div>
                <div class="p-3">
                    <button type="submit" class="btn btn-1">Lưu</button>
                    <button type="button" onclick="history.back()" class="btn btn-light border">Hủy</button>
                </div>
                
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-primary mb-3">
            <div class="card-header bg-primary text-white">Edit item</div>
            <div class="card-body">
                <form id="frmEdit" class="form-horizontal">
                    <div class="form-group">
                        <label for="text">Text</label>
                        <div class="input-group">
                            <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                            
                        </div>
                        <input type="hidden" name="icon" class="item-menu">
                    </div>
                    <div class="form-group">
                        <label for="href">URL</label>
                        <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                    </div>
                    <div class="form-group">
                        <label for="target">Target</label>
                        <select name="target" id="target" class="form-control item-menu">
                            <option value="_self">Self</option>
                            <option value="_blank">Blank</option>
                            <option value="_top">Top</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Tooltip</label>
                        <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
            </div>
        </div>
    </div>
</div>