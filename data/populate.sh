#!/bin/sh

# Populates the database with our 6 products

KEY=tvlL0BQ0QRIvQKwYVeS0Oiprb1grwMtaa5go7IyX
BUCKET=9e8b7829-93c0-4d82-a21e-c7153edcf5e5

curl -i -H "Authorization: Token ${KEY}" \
  -F 'title=Applegate Roast Beef' -F 'metadata={"decision":"happy", "No Antibiotics":true, "Gluten Free":true, "No Nitrates Added":true, "Humanely Raised":true}' \
  -F images=@./applegate-roast-beef.jpg \
  "https://upload-api.kooaba.com/api/v4/buckets/${BUCKET}/items"

curl -i -H "Authorization: Token ${KEY}" \
  -F 'title=Hormel Spam' -F 'metadata={"decision":"sad", "No Antibiotics":false, "Gluten Free":true, "No Nitrates Added":false, "Humanely Raised":false}' \
  -F images=@./hormel-spam.jpg \
  "https://upload-api.kooaba.com/api/v4/buckets/${BUCKET}/items"

curl -i -H "Authorization: Token ${KEY}" \
  -F 'title=Lunchables' -F 'metadata={"decision":"sad", "No Antibiotics":false, "Gluten Free":false, "No Nitrates Added":false, "Humanely Raised":false}' \
  -F images=@./lunchables.jpg \
  "https://upload-api.kooaba.com/api/v4/buckets/${BUCKET}/items"

curl -i -H "Authorization: Token ${KEY}" \
  -F 'title=Open Nature Prosciutto' -F 'metadata={"decision":"happy", "No Antibiotics":true, "Gluten Free":true, "No Nitrates Added":true, "Humanely Raised":true}' \
  -F images=@./open-nature-prosciutto.jpg \
  "https://upload-api.kooaba.com/api/v4/buckets/${BUCKET}/items"

curl -i -H "Authorization: Token ${KEY}" \
  -F 'title=Organic Chicken Noodle' -F 'metadata={"decision":"sad", "No Antibiotics":false, "Gluten Free":false, "No Nitrates Added":false, "Humanely Raised":true, "Organic":true}' \
  -F images=@./organic-chicken-noodle.jpg \
  "https://upload-api.kooaba.com/api/v4/buckets/${BUCKET}/items"

curl -i -H "Authorization: Token ${KEY}" \
  -F 'title=Oscar Mayer Bacon' -F 'metadata={"decision":"sad", "No Antibiotics":false, "Gluten Free":false, "No Nitrates Added":false, "Humanely Raised":false}' \
  -F images=@./oscar-mayer-bacon.jpg \
  "https://upload-api.kooaba.com/api/v4/buckets/${BUCKET}/items"