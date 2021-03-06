<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Waypoints in Directions</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div id="map"></div>
    <div id="right-panel">
      <div>
      <b>Start:</b>
      <select id="start">
        <option value="R. Daniel Filho, Itaueira - PI, 64820-000">R. Daniel Filho, Itaueira - PI, 64820-000</option>
        <option value="Piauí, BR">Piauí, BR</option>
        <option value="Halifax, NS">Halifax, NS</option>
        <option value="Boston, MA">Boston, MA</option>
        <option value="New York, NY">New York, NY</option>
        <option value="Miami, FL">Miami, FL</option>
      </select>
      <br>
      <b>Waypoints:</b> <br>
      <i>(Ctrl+Click or Cmd+Click for multiple selection)</i> <br>
      <select multiple id="waypoints">
        <option value="R. Francisco Rodrigues, Itaueira - PI, 64820-000">R. Francisco Rodrigues, Itaueira - PI, 64820-000</option>
        <option value="R. Castro Alves, Itaueira - PI, 64820-000">R. Castro Alves, Itaueira - PI, 64820-000</option>
        <option value="Conjunto Wanda, R. Quirino Avelino, Itaueira - PI, 64820-000">Conjunto Wanda, R. Quirino Avelino, Itaueira - PI, 64820-000</option>
        <option value="montreal, quebec">Montreal, QBC</option>
        <option value="toronto, ont">Toronto, ONT</option>
        <option value="chicago, il">Chicago</option>
        <option value="winnipeg, mb">Winnipeg</option>
      </select>
      <br>
      <b>End:</b>
      <select id="end">
        <option value="R. Sete de Setembro, Itaueira - PI, 64820-000">R. Sete de Setembro, Itaueira - PI, 64820-000</option>
        <option value="Maranhão, BR">Maranhão, BR</option>
        <option value="Vancouver, BC">Vancouver, BC</option>
        <option value="Seattle, WA">Seattle, WA</option>
        <option value="San Francisco, CA">San Francisco, CA</option>
        <option value="Los Angeles, CA">Los Angeles, CA</option>
      </select>
      <br>
        <input type="submit" id="submit">
      </div>
    <div id="right-panel">
      <div>
      <b>Start two:</b>
      <select id="startTwo">
        <option value="R. Daniel Filho, Itaueira - PI, 64820-000">R. Daniel Filho, Itaueira - PI, 64820-000</option>
        <option value="Piauí, BR">Piauí, BR</option>
      </select>
      <br>
      <b>Waypoints two:</b> <br>
      <i>(Ctrl+Click or Cmd+Click for multiple selection)</i> <br>
      <select multiple id="waypointsTwo">
        <option value="R. Francisco Rodrigues, Itaueira - PI, 64820-000">R. Francisco Rodrigues, Itaueira - PI, 64820-000</option>
        <option value="R. Castro Alves, Itaueira - PI, 64820-000">R. Castro Alves, Itaueira - PI, 64820-000</option>
        <option value="Conjunto Wanda, R. Quirino Avelino, Itaueira - PI, 64820-000">Conjunto Wanda, R. Quirino Avelino, Itaueira - PI, 64820-000</option>
      </select>
      <br>
      <b>End two:</b>
      <select id="endTwo">
        <option value="R. Sete de Setembro, Itaueira - PI, 64820-000">R. Sete de Setembro, Itaueira - PI, 64820-000</option>
        <option value="Maranhão, BR">Maranhão, BR</option>
      </select>
      <br>
        <input type="submit" id="submitTwo">
      </div>
    </div>
    <script>
    var user = <?php echo json_encode([
      'title one',
      'title two',
      'title three',
      'title four',
    ]); ?>;
    </script>
    <script src="js/main.js" charset="utf-8"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPwF1R-ehne8ti8s8JAAdJ1SfvV2JC7z8&callback=initMap">
    </script>
  </body>
</html>
