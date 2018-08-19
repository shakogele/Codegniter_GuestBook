<div
id="dataTables-example_wrapper"
class="dataTables_wrapper form-inline dt-bootstrap no-footer">
    <div class="row">
        <div class="col-sm-12">
            <table
                width="100%"
                class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                id="dataTables-example"
                role="grid"
                aria-describedby="dataTables-example_info"
                style="width: 100%;">
                <thead>
                    <tr role="row">
                        <th
                            tabindex="0"
                            rowspan="1"
                            colspan="1"
                            style="width: 50px;">
                            No
                          </th>
                          <th
                            tabindex="0"
                            rowspan="1"
                            colspan="1"
                            style="width: 160px;">
                            Title
                          </th>
                          <th
                            tabindex="0"
                            rowspan="1"
                            colspan="1"
                            style="width: 178px;">
                              Text
                          </th>
                          <th
                            tabindex="0"
                            rowspan="1"
                            colspan="1"
                            style="width: 100px;">
                              Approved
                          </th>
                          <th
                            tabindex="0"
                            rowspan="1"
                            colspan="1"
                            style="width: 139px;">
                              Created At
                          </th>
                          <th
                            tabindex="0"
                            rowspan="1"
                            colspan="1"
                            style="width: 104px;">
                              Updated At
                          </th>
                          <th
                            tabindex="0"
                            rowspan="1"
                            colspan="1"
                            style="width: 104px;">
                              Actions
                          </th>
                      </tr>
                </thead>
                <tbody>
                    <?php foreach ($reviews as $key => $review): ?>
                        <tr class="gradeA odd" role="row">
                            <td class="sorting_1"><?php echo $key+1; ?></td>
                            <td><?php echo $review['title']; ?></td>
                            <td><?php echo (strlen($review['text']) > 100)?substr($review['text'], 0, 100).'...' : $review['text']; ?></td>
                            <td class="center" style="text-align: center;"><?php echo ($review['approved']) ? '<i class="fa fa-check success" data-toggle="tooltip" data-placement="bottom" title="Approved"></i>': '<i class="fa fa-times danger" data-toggle="tooltip" data-placement="bottom" title="Not Approved"></i>'; ?></td>
                            <td class="center"><?php echo $review['created_at']; ?></td>
                            <td class="center"><?php echo $review['updated_at']; ?></td>
                            <td class="center">
                              <?php echo form_open('admin/change_review'); ?>
                                <input type="hidden" name="review_id" value="<?php echo $review['id'];?>" />
                                <div class="btn-group" role="group" aria-label="Basic example">
                                  <?php if($review['approved'] == 0 ){ ?>
                                  <button
                                      type="submit"
                                      data-toggle="tooltip"
                                      data-placement="bottom"
                                      title="Approve"
                                      name="submit"
                                      value="approve"
                                      class="btn btn-default btn-circle"><i class="fa fa-check"></i>
                                  </button>
                                  <?php } else { ?>
                                  <button
                                      type="submit"
                                      data-toggle="tooltip"
                                      data-placement="bottom"
                                      title="Disapprove"
                                      name="submit"
                                      value="dissapprove"
                                      class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                                  </button>
                                  <?php }?>
                                  <a
                                      type="button"
                                      data-toggle="tooltip"
                                      data-placement="bottom"
                                      href="<?php echo site_url('admin/edit_review/'.$review['slug'].''); ?>"
                                      title="Edit"
                                      class="btn btn-success btn-circle"><i class="fa fa-pencil"></i>
                                  </a>
                                  <button
                                      type="submit"
                                      data-toggle="tooltip"
                                      data-placement="bottom"
                                      title="Remove"
                                      name="submit"
                                      value="remove"
                                      class="btn btn-danger btn-circle"><i class="fa fa-times"></i>
                                  </button>
                                </div>
                              </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div
            class="dataTables_info"
            id="dataTables-example_info"
            role="status"
            aria-live="polite">
            Showing 1 to 10 of <?php echo sizeof($reviews) ?> entries
        </div>
      </div>
      <div class="col-sm-6">
        <div
          class="dataTables_paginate paging_simple_numbers"
          id="dataTables-example_paginate">
          <ul class="pagination">
            <?php echo $this->pagination->create_links();?>
          </ul>
        </div>
      </div>
    </div>
</div>
<!-- /.table-responsive -->
