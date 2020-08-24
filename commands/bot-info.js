// ██╗░░  ██████╗░██╗░░░░░███████╗░█████╗░░██████╗███████╗  ██████╗░███████╗░█████╗░██████╗░  ░░██╗
// ╚██╗░  ██╔══██╗██║░░░░░██╔════╝██╔══██╗██╔════╝██╔════╝  ██╔══██╗██╔════╝██╔══██╗██╔══██╗  ░██╔╝
// ░╚██╗  ██████╔╝██║░░░░░█████╗░░███████║╚█████╗░█████╗░░  ██████╔╝█████╗░░███████║██║░░██║  ██╔╝░
// ░██╔╝  ██╔═══╝░██║░░░░░██╔══╝░░██╔══██║░╚═══██╗██╔══╝░░  ██╔══██╗██╔══╝░░██╔══██║██║░░██║  ╚██╗░
// ██╔╝░  ██║░░░░░███████╗███████╗██║░░██║██████╔╝███████╗  ██║░░██║███████╗██║░░██║██████╔╝  ░╚██╗
// ╚═╝░░  ╚═╝░░░░░╚══════╝╚══════╝╚═╝░░╚═╝╚═════╝░╚══════╝  ╚═╝░░╚═╝╚══════╝╚═╝░░╚═╝╚═════╝░  ░░╚═╝

// ░░░░░░  ████████╗░█████╗░░██████╗  ███╗░░██╗░█████╗░████████╗██╗░█████╗░███████╗  ░░░░░░
// ░░░░░░  ╚══██╔══╝██╔══██╗██╔════╝  ████╗░██║██╔══██╗╚══██╔══╝██║██╔══██╗██╔════╝  ░░░░░░
// █████╗  ░░░██║░░░██║░░██║╚█████╗░  ██╔██╗██║██║░░██║░░░██║░░░██║██║░░╚═╝█████╗░░  █████╗
// ╚════╝  ░░░██║░░░██║░░██║░╚═══██╗  ██║╚████║██║░░██║░░░██║░░░██║██║░░██╗██╔══╝░░  ╚════╝
// ░░░░░░  ░░░██║░░░╚█████╔╝██████╔╝  ██║░╚███║╚█████╔╝░░░██║░░░██║╚█████╔╝███████╗  ░░░░░░
// ░░░░░░  ░░░╚═╝░░░░╚════╝░╚═════╝░  ╚═╝░░╚══╝░╚════╝░░░░╚═╝░░░╚═╝░╚════╝░╚══════╝  ░░░░░░
// This command is forbidden to be disabled or deleted, alongside other citatioons it is required for you to keep all credit. 
// Deleting this may result in you from being forbidden from using this service again - this is regularly monitored. 

const commando = require('discord.js-commando')
const Discord = require('discord.js');

class bot_information_command extends commando.Command {
    constructor(client) {

        super(client, {
            name: 'bot-info',
            aliases: ["whoareyou?", "botinfo", "bot-information", "botinformation", "bot", "whoareyou", "invite", "whoareyou"],
            group: 'utils',
            memberName: 'bot-info',
            description: 'Provides information about the bot.',
        });
    }

    async run(message, {}) {
        const embed = new Discord.RichEmbed()
            .setTitle("Bot Information")
            .setDescription(`This is a custom, private, bot has been made by <@173479730803113984>!

            For a quick, simple and efficient way to get custom made bots just like this for free, visit https://dbb.jtgreaves.com
            For more information or any queries please contact Josh.
            
            If there are any bugs found within the bot, please contact a staff member of the server and it will be resolved as quickly as possible. If you are a staff member and unsure what to do if you are told about a bug, please check the issue is not caused by any modifications on your end, if not contact Josh immediately.`)
            .setColor({%COLOUR_GEN%})
        message.channel.send(embed)
    }
}
module.exports = bot_information_command;