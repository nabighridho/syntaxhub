/**
 * IconMap — Maps string identifiers to react-icons SVG components.
 * Used across the app to replace emojis with modern, monochrome SVG icons
 * that match the dark brutalist theme.
 */
import {
    HiOutlineGlobe, HiOutlineWifi, HiOutlineTerminal,
    HiOutlineSwitchHorizontal, HiOutlineStatusOnline, HiOutlineMap,
    HiOutlineGlobeAlt, HiOutlineShieldCheck, HiOutlineCode,
    HiOutlineColorSwatch, HiOutlineDeviceMobile, HiOutlineLightningBolt,
    HiOutlineCog, HiOutlineCursorClick, HiOutlineDatabase,
    HiOutlineLink, HiOutlineCollection, HiOutlineRefresh,
    HiOutlinePencilAlt, HiOutlineStar, HiOutlineLocationMarker,
    HiOutlineBookOpen, HiOutlineSparkles,
    HiOutlineAcademicCap, HiOutlineBadgeCheck, HiOutlineBookmark,
    HiOutlineClipboardList, HiOutlineDocumentText,
    HiOutlineEye, HiOutlineKey, HiOutlineServer,
    HiOutlineChip, HiOutlineVariable, HiOutlineTemplate,
    HiOutlineCube, HiOutlineBeaker, HiOutlinePuzzle,
    HiOutlineAdjustments, HiOutlineFingerPrint,
} from 'react-icons/hi';

// Tutorial & badge icon mapping — identifier string → react-icon component
const iconComponents = {
    // TKJ icons
    'globe':            HiOutlineGlobe,
    'wifi':             HiOutlineWifi,
    'terminal':         HiOutlineTerminal,
    'switch':           HiOutlineSwitchHorizontal,
    'status':           HiOutlineStatusOnline,
    'map':              HiOutlineMap,
    'globe-alt':        HiOutlineGlobeAlt,
    'shield':           HiOutlineShieldCheck,
    'server':           HiOutlineServer,

    // RPL icons
    'code':             HiOutlineCode,
    'color-swatch':     HiOutlineColorSwatch,
    'device-mobile':    HiOutlineDeviceMobile,
    'lightning':        HiOutlineLightningBolt,
    'cog':              HiOutlineCog,
    'cursor':           HiOutlineCursorClick,
    'database':         HiOutlineDatabase,
    'link':             HiOutlineLink,
    'collection':       HiOutlineCollection,
    'refresh':          HiOutlineRefresh,
    'pencil':           HiOutlinePencilAlt,
    'cube':             HiOutlineCube,
    'beaker':           HiOutlineBeaker,
    'puzzle':           HiOutlinePuzzle,
    'template':         HiOutlineTemplate,
    'chip':             HiOutlineChip,
    'variable':         HiOutlineVariable,
    'key':              HiOutlineKey,
    'fingerprint':      HiOutlineFingerPrint,
    'adjustments':      HiOutlineAdjustments,
    'eye':              HiOutlineEye,

    // Badge icons
    'star':             HiOutlineStar,
    'location':         HiOutlineLocationMarker,
    'book-open':        HiOutlineBookOpen,
    'crown':            HiOutlineStar,
    'sparkles':         HiOutlineSparkles,
    'academic-cap':     HiOutlineAcademicCap,
    'badge-check':      HiOutlineBadgeCheck,
    'bookmark':         HiOutlineBookmark,
    'clipboard':        HiOutlineClipboardList,
    'document':         HiOutlineDocumentText,
};

/**
 * Renders an SVG icon from a string identifier.
 * Falls back to the identifier text if no match found.
 */
export default function IconMap({ name, className = 'w-5 h-5', ...props }) {
    const IconComponent = iconComponents[name];

    if (IconComponent) {
        return <IconComponent className={className} {...props} />;
    }

    // Fallback: render text (shouldn't happen with proper mapping)
    return <span className={className} {...props}>{name}</span>;
}

// Export the map for direct access if needed
export { iconComponents };
