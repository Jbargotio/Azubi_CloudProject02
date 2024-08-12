provider "aws" {
  region = "us-east-1"
}

resource "aws_dynamodb_table" "guestlist" {
  name           = "guestbook"
  billing_mode   = "PROVISIONED"
  read_capacity  = 10
  write_capacity = 10
  hash_key       = "Email"

  attribute {
    name = "Email"
    type = "S"
  }

  attribute {
    name = "Name"
    type = "S"
  }

  attribute {
    name = "Country"
    type = "S"
  }
  # Global Secondary Index for Name
  global_secondary_index {
    name            = "NameIndex"
    hash_key        = "Name"
    projection_type = "ALL"
    read_capacity   = 5
    write_capacity  = 5
  }

  # Global Secondary Index for Country
  global_secondary_index {
    name            = "CountryIndex"
    hash_key        = "Country"
    projection_type = "ALL"
    read_capacity   = 5
    write_capacity  = 5
  }

  tags = {
    Name = "MyDynamoDBTable"
    Environment = "Training"
  }
}

resource "aws_dynamodb_table_item" "item1" {
  table_name = aws_dynamodb_table.guestlist.name

  hash_key = "Email"
  item = <<ITEM
{
  "Email": {"S": "ayobami.aborisade@azubiafrica.org"},
  "Name": {"S": "Ayobami"},
  "Country": {"S": "Nigeria"}
}
ITEM
}

resource "aws_dynamodb_table_item" "item2" {
  table_name = aws_dynamodb_table.guestlist.name

  hash_key = "Email"
  item = <<ITEM
{
  "Email": {"S": "brian.bange@azubiafrica.org"},
  "Name": {"S": "Brian Bange"},
  "Country": {"S": "Kenya"}
}
ITEM
}

resource "aws_dynamodb_table_item" "item3" {
  table_name = aws_dynamodb_table.guestlist.name

  hash_key = "Email"
  item = <<ITEM
{
  "Email": {"S": "david.dumfeh@azubiafrica.org"},
  "Name": {"S": "David Dumfeh"},
  "Country": {"S": "Ghana"}
}
ITEM
}
resource "aws_dynamodb_table_item" "item4" {
  table_name = aws_dynamodb_table.guestlist.name

  hash_key = "Email"
  item = <<ITEM
{
  "Email": {"S": "michael.danquah@azubiafrica.org"},
  "Name": {"S": "Michael Danquah"},
  "Country": {"S": "Ghana"}
}
ITEM
}