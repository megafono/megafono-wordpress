<div class="wrap">
  <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>


    <form method="post" action="<?php echo esc_html( admin_url( 'admin.php?page=megafono' ) ); ?>">
      <table class="form-table">
          <tbody>
              <tr class="form-field form-required">
                  <th scope="row">
                     <label for="megafono_uid">Megafono UID</label>
                  </th>
                  <td>
                      <input type='text' id='megafono_uid' name='megafono_uid' value="<?php echo $uid_value ?>"></input>
                      <br>
                      <span class="description">
                          Para encontrar basta olhar para sua URL do Megafono, o UID, normalmente, é o nome do seu podcast com letra minusculas, sem espaço(trocados por _ or -) e sem acentos.
                          <br />
                          <br />
                          Exemplos (em negrito o UID):<br />
                          O Duke: https://feed.megafono.host/<strong>duke</strong><br />
                          Megafono Changelog: https://feed.megafono.host/<strong>megafono-changelog</strong>

                      </span>
                  </td>
              <tr>
          </tbody>
      </table>
      <?php
        wp_nonce_field( 'megafono-settings-save', 'megafono-settings' );
        submit_button();
      ?>
  </form>
</div>