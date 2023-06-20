<div class="row">
    <div class="card col-md-7 mx-auto my-l">
        <?php
        include './includes/form.inc.html';

        ?>
    </div>
    <!-- Ajouter plus de données -->
    <div class="card col-md-4 mx-auto my-l">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                HTML
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                CSS
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                JavaScript
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                PHP
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                MySQL
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Bootstrap
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Symphony
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                React
            </label>
        </div>
        <div class="form-check">
            <label for="exampleColorInput" class="form-label">Couleur préférée</label>
            <input type="color" class="form-control form-control-color" id="exampleColorInput" value="#0000" title="Choose your color">
        </div>
        <div class="form-group">
            <label for="date" class="form-label mt-4">Date de naissance</label>
            <input type="date" name="date" class="form-control" id="_date" required>
        </div>
    </div>
    <div class="form-group card col-md-11 mx-auto my-l">
        <label for="formFile" class="form-label mt-4">Joindre une image JPEG ou PNG</label>
        <input class="form-control" type="file" id="formFile">
    </div>
</div>