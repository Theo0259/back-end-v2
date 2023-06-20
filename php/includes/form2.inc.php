<div class="row">
    <div class="card col-md-7 mx-auto my-l">
        <?php
        include './includes/form.inc.html';

        ?>
    </div>
    <!-- Ajouter plus de données -->
    <div class="card col-md-4 mx-auto my-l">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="HTML"  name="HTML">
            <label class="form-check-label" for="HTML">
                HTML
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="CSS"  name="CSS">
            <label class="form-check-label" for="CSS">
                CSS
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="JS"  name="JS">
            <label class="form-check-label" for="JS">
                JavaScript
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="PHP"  name="PHP">
            <label class="form-check-label" for="PHP">
                PHP
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="MySQL"  name="MySQL">
            <label class="form-check-label" for="MySQL">
                MySQL
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Bootstrap"  name="Bootstrap">
            <label class="form-check-label" for="Bootstrap">
                Bootstrap
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Symphony"  name="Symphony">
            <label class="form-check-label" for="Symphony">
                Symphony
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="React"  name="React">
            <label class="form-check-label" for="React">
                React
            </label>
        </div>
        <div class="form-check">
            <label for="exampleColorInput" class="form-label">Couleur préférée</label>
            <input type="color" class="form-control form-control-color" id="exampleColorInput" value="#0000" title="Choose your color" name="color">
        </div>
        <div class="form-group">
            <label for="date" class="form-label mt-4">Date de naissance</label>
            <input type="date" name="date" class="form-control" id="_date" required>
        </div>
    </div>
    <div class="form-group card col-md-11 mx-auto my-l">
        <label for="formFile" class="form-label mt-4">Joindre une image (jpg ou png)</label>
        <input class="form-control" type="file" id="formFile" name="file">
    </div>
</div>