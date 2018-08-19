<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
          Edit Review
          <br />
          <a href="<?php echo site_url('admin/reviews');?>" class="btn btn-outline btn-default">Go Back</a>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $review_item['title']; ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open(''); ?>
                            <?php echo validation_errors(); ?>
                            <div class="form-group">
                                <label for="email">Adder's Email</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    disabled="disabled"
                                    value="<?php echo $review_item['email']; ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Adder's Name</label>
                                <input
                                    type="text"
                                    id="name"
                                    disabled="disabled"
                                    name="name"
                                    value="<?php echo $review_item['name']; ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Review Title</label>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    value="<?php echo $review_item['title']; ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="text">Review Text</label>
                                <textarea
                                    id="text"
                                    name="text"
                                    class="form-control">
                                    <?php echo $review_item['text']; ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Approved/ Not Approved</label>
                                <div class="checkbox">
                                    <label>
                                        <input
                                          type="checkbox"
                                          name="approved"
                                          <?php if($review_item['approved'] == 1){ echo 'checked="checked"'; } ?>
                                          value="1">Approve
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default pull-right">Save Changes</button>
                        </form>
                    </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
