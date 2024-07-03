
exports.up = function (knex) {
  return knex.schema
    .createTable('todo', async function (table) {
      table.boolean('state').defaultTo(false);
      table.string('item');
      table.string('description');
      table.string('due_date');
    })
    .then(async () => {
      await knex('todo').insert({ "state": false, "item": "laundry", "description": "desc", "due_date": "monday" }),
        await knex('todo').insert({ "state": true, "item": "clean", "description": "desciptor", "due_date": "sunday" })
    })
};

exports.down = function (knex) {
  return knex.schema
    .dropTable('todo')
};
