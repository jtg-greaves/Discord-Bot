const commando = require('discord.js-commando')
const Discord = require('discord.js');

class clear_command extends commando.Command {
    constructor(client) {

        super(client, {
            name: 'clear',
            group: 'moderation',
            memberName: 'clear',
            description: 'Clears message.',
            userPermissions: ['MANAGE_MESSAGES'],
            args: [{
                key: 'amount',
                prompt: 'How many messages would you like to clear?',
                type: 'integer',
            }]
        });
    }

    async run(message, { amount }) {

        message.channel.bulkDelete(amount + 1)

        const embed = new Discord.RichEmbed()
            .setColor("{%COLOUR_MOD%}")
            .setAuthor('Moderation')
            .setDescription("Messages Cleared: " + amount)
            .setTimestamp()
            .setFooter('Moderation');
        message.channel.send(embed);

        const logmessage = new Discord.RichEmbed()
            .setColor("{%COLOUR_LOG%}")
            .setTitle("Clear Log")
            .setDescription(message.author + " cleared " + amount + " messages in " + message.channel)
            .setTimestamp()
            .setFooter("@" + message.author.username + " » ID:" + message.author.id)

        const logs = message.guild.channels.find(channel => channel.name === "logs");
        logs.send(logmessage)
        return;
    }
}
module.exports = clear_command;