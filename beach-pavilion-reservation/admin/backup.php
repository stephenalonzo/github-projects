<?php
                                
                  $results = dataView($params);

                  foreach ($results as $row) {
                                
                  ?>
                  <tr>
                    <td class="px-4 py-2 text-gray-700 flex flex-row items-center space-x-2">
                      <p>
                        <?php echo $row['pavName']; ?>
                      </p>
                      <input type="text" name="confirmation" value="<?php echo $row['id']; ?>" class="hidden" readonly>
                      <?php if ($row['pavStatus'] == 'RESERVED') { ?>
                      <strong class="bg-green-600/25 text-green-600 px-3 py-1.5 rounded text-xs font-medium">
                        RESERVED
                      </strong>
                      <?php } elseif ($row['pavStatus'] == 'PENDING') { ?>
                      <strong class="bg-[#f4a261]/25 text-orange-600 px-3 py-1.5 rounded text-xs font-medium">
                        PENDING
                      </strong>
                      <?php } else { ?>
                      <strong class="bg-red-600/25 text-red-600 px-3 py-1.5 rounded text-xs font-medium">
                        CANCELED
                      </strong>
                      <?php } ?>
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                      <?php echo date('m/d/Y', strtotime($row['resStart'])); ?>
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                      <p>
                        <?php echo $row['confirmID']; ?>
                      </p>
                    </td>
                    <td class="px-4 py-2 text-gray-700 flex items-center justify-center space-x-4">
                      <?php if ($row['pavStatus'] == 'RESERVED') { ?>
                      <a onclick="return confirm('By clicking OK, you agree that the customer has canceled their reservation.')" href="./cancel.php?id=<?php echo $row['id'];?>" name="confirm" class=" px-4 py-2 rounded-md bg-red-600 text-white border-2 border-red-600 text-xs uppercase font-medium hover:bg-white hover:text-red-600 duration-200">
                        <i class="fas fa-times text-xs"></i>
                      </a>
                      <button type="button" onclick="printReceipt('<?php echo $row['confirmID']; ?>')" class="px-4 py-2 rounded-md bg-gray-200 text-gray-400 border-2 border-gray-200 text-xs uppercase font-medium hover:bg-gray-400 hover:text-white duration-200">
                        <i class="fas fa-print text-xs"></i>
                      </button>
                      <?php } elseif ($row['pavStatus'] == 'CANCELED') { ?>

                      <?php } else { ?>
                      <a href="./confirm.php?id=<?php echo $row['id'];?>" name="confirm" class="px-4 py-2 rounded-md bg-green-600 text-white border-2 border-green-600 text-xs uppercase font-medium hover:bg-white hover:text-green-600 duration-200">
                        <i class="fas fa-check text-xs"></i>
                      </a>
                      <a onclick="return confirm('By clicking OK, you agree that the customer has canceled their reservation.')" href="./cancel.php?id=<?php echo $row['id'];?>" name="confirm" class=" px-4 py-2 rounded-md bg-red-600 text-white border-2 border-red-600 text-xs uppercase font-medium hover:bg-white hover:text-red-600 duration-200">
                        <i class="fas fa-times text-xs"></i>
                      </a>
                      <?php } ?>
                    </td>
                  </tr>
                  <?php } ?>