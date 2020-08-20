const commando = require('discord.js-commando')
const Discord = require('discord.js');

class status_command extends commando.Command {
    constructor(client) {

        super(client, {
            name: 'status',
            group: 'bot-information-&-management',
            memberName: 'status',
            description: 'Sets the bot\'s status.',
            ownerOnly: true,
            args: [{
                key: 'status',
                prompt: 'What status e.g. (Making bots @ db.jtgreaves.com)',
                type: 'string',
            }]
        });
    }

    async run(message, { status }) {
        bot.user.setStatus('available')
        bot.user.setPresence({ game: { name: status } })


        const embed = new Discord.RichEmbed()
            .setColor("{%COLOUR_GEN%}")
            .setTitle("Status")
            .setDescription("Status set to: `" + status + "`.")
            .setTimestamp()
        message.channel.send(embed);

        const logmessage = new Discord.RichEmbed()
            .setColor("{%COLOUR_LOG%}")
            .setTitle("Status Change Log")
            .setDescription(message.author + " set the bot\'s status to `" + status + "`.")
            .setTimestamp()
            .setFooter("@" + message.author.username + " » ID:" + message.author.id)

        const logs = message.guild.channels.find(channel => channel.name === "logs");
        logs.send(logmessage);
        return;
    }
}
module.exports = status_command;