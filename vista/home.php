<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-header text-bg-muted p-2"></div>
            <div class="card-body">
                <h3 class="display-3">Bienvenidos</h3>
                <p class="lead">Este es un CRUD con Login y Register</p>
                <hr class="my-2">
                <p>Este es el proyecto final para el curso de la municipalidad de tres de febrero</p>
            </div>
            <div class="card-footer text-bg-muted p-2"></div>
        </div>
    </div>
</div>


<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 my-2">
    <?php if (!empty($productos)) : ?>
        <?php foreach ($productos as $producto) : ?>
            <div class="col">
                <div class="card h-100">
                    <div class="image-container">
                        <img src="../../tp-final-curso3f/public/images/product_placeholder.png" class="card-img-top" alt="imagen de referencia de <?php echo $producto['name']; ?>">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo $producto['name']; ?></h5>
                        <p class="card-text"><?php echo $producto['description']; ?></p>
                    </div>
                    <div class="card-footer bg-success text-white">
                        <small class="lead">$<?php echo $producto['price']; ?> USD</small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No hay productos disponibles.</p>
    <?php endif; ?>
</div>