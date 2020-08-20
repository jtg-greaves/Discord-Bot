const commando = require('discord.js-commando')
const Discord = require('discord.js');

class moveall_command extends commando.Command {
    constructor(client) {

        super(client, {
            name: 'moveall',
            aliases: ['vmoveall', 'vma'],
            group: 'moderation',
            memberName: 'moveall',
            description: 'Moves all members in your current voice channel to another channel.',
            userPermissions: ['MOVE_MEMBERS'],
            args: [{
                key: 'voicechannel',
                prompt: 'What channel do you want to move people to?',
                type: 'string'
            }]
        });
    }

    async run(message, { voicechannel }) {


        if (message.member.voiceChannel) {
            var original = message.member.voiceChannel;

            var moved = message.guild.channels.find((channel) => channel.name === voicechannel)

            if (moved == null) {
                const embed = new Discord.RichEmbed()
                    .setColor("{%COLOUR_ERROR%}")
                    .setTitle("Error")
                    .setDescription("The voice channel `" + voicechannel + "` is not found, make sure it is exact.")
                    .setTimestamp()
                message.channel.send(embed);
                return;
            } else {

                original.members.forEach(function(guildMember, guildMemberId) {
                    // console.log(guildMemberId, guildMember.user.username);
                    // console.log("Moving " + guildMember.user.username + " to " + moved)
                    guildMember.setVoiceChannel(moved);
                })

                const embed = new Discord.RichEmbed()
                    .setColor("{%COLOUR_MOD%}")
                    .setTitle("Voice Move All")
                    .setDescription("Successfully moved everyone in " + original + " to " + moved + ".")
                    .setTimestamp()
                message.channel.send(embed);

                const logmessage = new Discord.RichEmbed()
                    .setColor("{%COLOUR_LOG%}")
                    .setTitle("Move All Log")
                    .setDescription(message.author + "moved everyone in " + original + " to " + moved + ".")
                    .setTimestamp()
                    .setFooter("@" + message.author.username + " » ID:" + message.author.id)

                const logs = message.guild.channels.find(channel => channel.name === "logs");
                logs.send(logmessage)
                return;
            }
        } else {
            const embed = new Discord.RichEmbed()
                .setColor("{%COLOUR_ERROR%}")
                .setTitle("Error")
                .setDescription(message.author + " you must be in a voice channel to use this command!")
                .setTimestamp()
            message.channel.send(embed);
            return;
        }

    }
}


module.exports = moveall_command;